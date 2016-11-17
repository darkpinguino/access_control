<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * VehicleProfiles Controller
 *
 * @property \App\Model\Table\VehicleProfilesTable $VehicleProfiles
 */
class VehicleProfilesController extends AppController
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
        $vehicleProfiles = $this->paginate($this->VehicleProfiles);

        $this->set(compact('vehicleProfiles'));
        $this->set('_serialize', ['vehicleProfiles']);
    }

    /**
     * View method
     *
     * @param string|null $id Vehicle Profile id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $vehicleProfile = $this->VehicleProfiles->get($id, [
            'contain' => ['Companies']
        ]);

        $this->set('vehicleProfile', $vehicleProfile);
        $this->set('_serialize', ['vehicleProfile']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $vehicleProfile = $this->VehicleProfiles->newEntity();
        if ($this->request->is('post')) {
            $company_id = $this->Auth->user()['company_id'];
            $vehicleProfile = $this->VehicleProfiles->patchEntity($vehicleProfile, $this->request->data);
            $vehicleProfile->company_id = $company_id;
            if ($this->VehicleProfiles->save($vehicleProfile)) {
                $this->Flash->success(__('El perfil ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El perfil no ha podido ser guradado. Por favor intente nuevamente.'));
            }
        }
        $this->set(compact('vehicleProfile', 'companies'));
        $this->set('_serialize', ['vehicleProfile']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Vehicle Profile id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $vehicleProfile = $this->VehicleProfiles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $vehicleProfile = $this->VehicleProfiles->patchEntity($vehicleProfile, $this->request->data);
            if ($this->VehicleProfiles->save($vehicleProfile)) {
                $this->Flash->success(__('El perfil ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El perfil no ha podido ser guradado. Por favor intente nuevamente.'));
            }
        }
        $companies = $this->VehicleProfiles->Companies->find('list', ['limit' => 200]);
        $this->set(compact('vehicleProfile', 'companies'));
        $this->set('_serialize', ['vehicleProfile']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Vehicle Profile id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $vehicleProfile = $this->VehicleProfiles->get($id);
        if ($this->VehicleProfiles->delete($vehicleProfile)) {
            $this->Flash->success(__('The vehicle profile has been deleted.'));
        } else {
            $this->Flash->error(__('The vehicle profile could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
