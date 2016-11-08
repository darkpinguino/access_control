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

        $this->set(compact('forms'));
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
            $this->Flash->error(__('El formualrio no pudo ser eliminado. Por favor intente nuevamente.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
