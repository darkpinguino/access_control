<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SensorData Controller
 *
 * @property \App\Model\Table\SensorDataTable $SensorData
 */
class SensorDataController extends AppController
{

    public $paginate = [
        'contain' => ['SensorTypes', 'People', 'Companies']
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sensorData = $this->paginate($this->SensorData);

        $this->set(compact('sensorData'));
        $this->set('_serialize', ['sensorData']);
    }

    /**
     * View method
     *
     * @param string|null $id Sensor Data id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sensorData = $this->SensorData->get($id, [
            'contain' => ['SensorTypes', 'People', 'Companies']
        ]);

        $this->set('sensorData', $sensorData);
        $this->set('_serialize', ['sensorData']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sensorData = $this->SensorData->newEntity();
        if ($this->request->is('post')) {
            $sensorData = $this->SensorData->patchEntity($sensorData, $this->request->data);
            if ($this->SensorData->save($sensorData)) {
                $this->Flash->success(__('The sensor data has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sensor data could not be saved. Please, try again.'));
            }
        }
        $sensorTypes = $this->SensorData->SensorTypes->find('list', ['limit' => 200]);
        $people = $this->SensorData->People->find('list', ['limit' => 200]);
        $companies = $this->SensorData->Companies->find('list', ['limit' => 200]);
        $this->set(compact('sensorData', 'sensorTypes', 'people', 'companies'));
        $this->set('_serialize', ['sensorData']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sensor Data id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sensorData = $this->SensorData->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sensorData = $this->SensorData->patchEntity($sensorData, $this->request->data);
            if ($this->SensorData->save($sensorData)) {
                $this->Flash->success(__('The sensor data has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sensor data could not be saved. Please, try again.'));
            }
        }
        $sensorTypes = $this->SensorData->SensorTypes->find('list', ['limit' => 200]);
        $people = $this->SensorData->People->find('list', ['limit' => 200]);
        $companies = $this->SensorData->Companies->find('list', ['limit' => 200]);
        $this->set(compact('sensorData', 'sensorTypes', 'people', 'companies'));
        $this->set('_serialize', ['sensorData']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sensor Data id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sensorData = $this->SensorData->get($id);
        if ($this->SensorData->delete($sensorData)) {
            $this->Flash->success(__('The sensor data has been deleted.'));
        } else {
            $this->Flash->error(__('The sensor data could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
