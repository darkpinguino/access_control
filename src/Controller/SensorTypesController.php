<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * SensorTypes Controller
 *
 * @property \App\Model\Table\SensorTypesTable $SensorTypes
 */
class SensorTypesController extends AppController
{

    public $paginate = [
       'contain' => ['Companies']
    ];
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $sensorTypes = $this->paginate($this->SensorTypes);

        $this->set(compact('sensorTypes'));
        $this->set('_serialize', ['sensorTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Sensor Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $sensorType = $this->SensorTypes->get($id, [
            'contain' => ['Companies', 'SensorData', 'Sensors']
        ]);

        $this->set('sensorType', $sensorType);
        $this->set('_serialize', ['sensorType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $sensorType = $this->SensorTypes->newEntity();
        if ($this->request->is('post')) {
            $sensorType = $this->SensorTypes->patchEntity($sensorType, $this->request->data);
            if ($this->SensorTypes->save($sensorType)) {
                $this->Flash->success(__('El tipo de senson ha sido guardado.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('El tipo de senson no ha podido ser guradado. Por favor, intente nuevamente.'));
            }
        }
        $companies = $this->SensorTypes->Companies->find('list', ['limit' => 200]);
        $this->set(compact('sensorType', 'companies'));
        $this->set('_serialize', ['sensorType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Sensor Type id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $sensorType = $this->SensorTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sensorType = $this->SensorTypes->patchEntity($sensorType, $this->request->data);
            if ($this->SensorTypes->save($sensorType)) {
                $this->Flash->success(__('The sensor type has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The sensor type could not be saved. Please, try again.'));
            }
        }
        $companies = $this->SensorTypes->Companies->find('list', ['limit' => 200]);
        $this->set(compact('sensorType', 'companies'));
        $this->set('_serialize', ['sensorType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Sensor Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sensorType = $this->SensorTypes->get($id);
        if ($this->SensorTypes->delete($sensorType)) {
            $this->Flash->success(__('The sensor type has been deleted.'));
        } else {
            $this->Flash->error(__('The sensor type could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
