<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ReasonVisits Controller
 *
 * @property \App\Model\Table\ReasonVisitsTable $ReasonVisits
 */
class ReasonVisitsController extends AppController
{
    public $controllerName = 'la Razón de Visita';

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $reasonVisits = $this->paginate($this->ReasonVisits);
        $displayField = $this->ReasonVisits->displayField();

        $this->set(compact('reasonVisits','displayField'));
        $this->set('controllerName', $this->controllerName);
        $this->set('_serialize', ['reasonVisits']);
    }

    /**
     * View method
     *
     * @param string|null $id Reason Visit id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $reasonVisit = $this->ReasonVisits->get($id, [
            'contain' => []
        ]);

        $this->set('reasonVisit', $reasonVisit);
        $this->set('_serialize', ['reasonVisit']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $reasonVisit = $this->ReasonVisits->newEntity();
        if ($this->request->is('post')) {
            $reasonVisit = $this->ReasonVisits->patchEntity($reasonVisit, $this->request->data);
            if ($this->ReasonVisits->save($reasonVisit)) {
                $this->Flash->success(__('The reason visit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reason visit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('reasonVisit'));
        $this->set('_serialize', ['reasonVisit']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Reason Visit id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $reasonVisit = $this->ReasonVisits->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reasonVisit = $this->ReasonVisits->patchEntity($reasonVisit, $this->request->data);
            if ($this->ReasonVisits->save($reasonVisit)) {
                $this->Flash->success(__('The reason visit has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The reason visit could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('reasonVisit'));
        $this->set('_serialize', ['reasonVisit']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Reason Visit id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reasonVisit = $this->ReasonVisits->get($id);
        if ($this->ReasonVisits->delete($reasonVisit)) {
            $this->Flash->success(__('The reason visit has been deleted.'));
        } else {
            $this->Flash->error(__('The reason visit could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
