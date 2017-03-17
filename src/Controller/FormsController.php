<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Forms Controller
 *
 * @property \App\Model\Table\FormsTable $Forms
 */
class FormsController extends AppController
{

	public $controllerName = 'el Formulario';

	public function isAuthorized($user)
	{
		
		return true;
		
		return parent::isAuthorized($user);
	}

	/**
	 * Index method
	 *
	 * @return \Cake\Network\Response|null
	 */
	public function index()
	{
		$this->paginate = [
			'contain' => ['Companies']
		];
		$forms = $this->paginate($this->Forms);
		
		$displayField = $this->Forms->displayField();

		$this->set(compact('forms','displayField'));
		$this->set('controllerName', $this->controllerName);
		$this->set('_serialize', ['forms']);
	}

	/**
	 * View method
	 *
	 * @param string|null $id Form id.
	 * @return \Cake\Network\Response|null
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function view($id = null)
	{
		$form = $this->Forms->get($id, [
			'contain' => ['Companies']
		]);

		$this->set('form', $form);
		$this->set('_serialize', ['form']);
	}

	/**
	 * Add method
	 *
	 * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$form = $this->Forms->newEntity();
		if ($this->request->is('post')) {
			$company_id = $this->Auth->user()['company_id'];
			$form = $this->Forms->patchEntity($form, $this->request->data);
			$form->company_id=$company_id;
			//debug($this->request->data);die;
			if ($this->Forms->save($form)) {
				$this->Flash->success(__('Este formulario ha sido creado exitosamente.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El formulario no ha podido ser creado. Por favor intente nuevamente.'));
			}
		}
		$companies = $this->Forms->Companies->find('list', ['limit' => 200]);
		$this->set(compact('form', 'companies'));
		$this->set('_serialize', ['form']);
	}

	/**
	 * Edit method
	 *
	 * @param string|null $id Form id.
	 * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
	 * @throws \Cake\Network\Exception\NotFoundException When record not found.
	 */
	public function edit($id = null)
	{
		$form = $this->Forms->get($id, [
			'contain' => []
		]);
		if ($this->request->is(['patch', 'post', 'put'])) {
			$form = $this->Forms->patchEntity($form, $this->request->data);
			if ($this->Forms->save($form)) {
				$this->Flash->success(__('El formulario fue editado exitosamente'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El formulario no pudo ser guardado correctamente. Por favor intente de nuevo.'));
			}
		}
		$companies = $this->Forms->Companies->find('list', ['limit' => 200]);
		$this->set(compact('form', 'companies'));
		$this->set('_serialize', ['form']);
	}

	/**
	 * Delete method
	 *
	 * @param string|null $id Form id.
	 * @return \Cake\Network\Response|null Redirects to index.
	 * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);
		$form = $this->Forms->get($id);
		if ($this->Forms->delete($form)) {
			$this->Flash->success(__('El formulario ha sido eliminado exitosamente.'));
		} else {
			$this->Flash->error(__('El formulario no pudo ser eliminado. Por favor intente nuevamente.'));
		}
		return $this->redirect(['action' => 'index']);
	}

	public function respondForm($id = null)
	{
		$this->loadmodel('AnswersSets');
		$answer_set = $this->AnswersSets->newEntity();
		//$form = $this->Forms->find($id, ['contain' => 'Questions']);
		$form = $this->Forms->find()
			->where(['Forms.id' => $id])
			->contain(['Questions'])
			->first();
		//Hasta acá es para cargar las preguntas del formulario.
		$answer_set->form_id = $form->id;
		//debug($form); die;

		if ($this->request->is('post')) {
			$answer_set = $this->AnswersSets->patchEntity($answer_set, $this->request->data);
			//debug($answer_set); die;

			if($this->AnswersSets->save($answer_set)){
				$this->Flash->success(__('Este formulario ha respondido exitosamente.'));
				return $this->redirect(['action' => 'index']);
			} else {
				$this->Flash->error(__('El formulario no ha podido ser respondido.
				 Por favor intente nuevamente.'));
			}

		}

		$this->set(compact('form','answer_set'));
	}

	function ajaxMeasures($question_count) {
		$measures =	$this->Forms->Questions->Measures->find('list');
		$this->set(compact('measures', 'question_count'));

		$this->render('/Element/ajax_dropdown');
	}

	public function indexAnsweredForm($id = null)
	{
		//$answers_sets = $this->Forms->get($id, ['contain' => 'AnswersSets'])->answers_sets;
		$answers_sets = $this->Forms->AnswersSets->find()
			->where(['AnswersSets.form_id' => $id]);
		$answers_sets = $this->paginate($answers_sets);
		$this->set(compact('answers_sets'));

	}

	public function viewAnsweredForm($id = null)
	{
		$answers_sets = $this->Forms->AnswersSets->get($id, [
			'contain' => ['Answers.Questions','Forms']
		]);
		//debug($answers_sets); die;
		$this->set('answers_sets', $answers_sets);
		$this->set('_serialize', ['answers_sets']);
	}

	public function vehicleRespondForm()
	{
		$company_id = $this->Auth->user('company_id');

		$vehicle_access = $this->request->session()->read('vehicle_access');

		if ($this->request->is('post')) {

			$answer_set = $this->Forms->AnswersSets->newEntity();
			$answer_set = $this->Forms->AnswersSets->patchEntity($answer_set, $this->request->data);

			if ($this->Forms->AnswersSets->save($answer_set)) {
				$vehicle_access_request = $this->Forms->AnswersSets->VehicleAccessRequest->newEntity();
				$vehicle_access_request->id = $this->request->session()->read('vehicle_access_request');
				$vehicle_access_request->answer_set_id = $answer_set->id;
				$this->Forms->AnswersSets->VehicleAccessRequest->save($vehicle_access_request);
				$this->Flash->success('Formulario respondido con exito.');
			} else {
				$this->Flash->error('El formulario no ha podido ser respondido.');
				$this->redirect(['action' => 'passangerRedirect', 'controller' => 'authorization']);
			}
		}

		$forms = $this->Forms->find('list')
			->where(['company_id' => $company_id]);

		$this->set(compact('forms'));

	}

	public function getForm($form_id = null, $controller = null, $action = null)
	{
		$url = [];
		$url['controller'] = $controller;
		$url['action'] = $action;
		$answer_set = $this->Forms->AnswersSets->newEntity();
		$form = $this->Forms->get($form_id, [
			'contain' => 'Questions']);

		$this->set(compact('form', 'answer_set', 'url'));
		$this->render('../Element/Forms/respond_form');
	}
}
