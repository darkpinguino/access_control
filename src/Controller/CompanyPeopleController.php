<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CompanyPeople Controller
 *
 * @property \App\Model\Table\CompanyPeopleTable $CompanyPeople
 */
class CompanyPeopleController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $companyPeople = $this->paginate($this->CompanyPeople);

        $this->set(compact('companyPeople'));
        $this->set('_serialize', ['companyPeople']);
    }

    /**
     * View method
     *
     * @param string|null $id Company Person id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $companyPerson = $this->CompanyPeople->get($id, [
            'contain' => []
        ]);

        $this->set('companyPerson', $companyPerson);
        $this->set('_serialize', ['companyPerson']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $companyPerson = $this->CompanyPeople->newEntity();
        if ($this->request->is('post')) {
            $companyPerson = $this->CompanyPeople->patchEntity($companyPerson, $this->request->data);
            if ($this->CompanyPeople->save($companyPerson)) {
                $this->Flash->success(__('The company person has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company person could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('companyPerson'));
        $this->set('_serialize', ['companyPerson']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company Person id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $companyPerson = $this->CompanyPeople->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $companyPerson = $this->CompanyPeople->patchEntity($companyPerson, $this->request->data);
            if ($this->CompanyPeople->save($companyPerson)) {
                $this->Flash->success(__('The company person has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The company person could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('companyPerson'));
        $this->set('_serialize', ['companyPerson']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company Person id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $companyPerson = $this->CompanyPeople->get($id);
        if ($this->CompanyPeople->delete($companyPerson)) {
            $this->Flash->success(__('The company person has been deleted.'));
        } else {
            $this->Flash->error(__('The company person could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
