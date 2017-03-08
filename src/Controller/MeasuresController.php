<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Measures Controller
 *
 * @property \App\Model\Table\MeasuresTable $Measures
 */
class MeasuresController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $measures = $this->paginate($this->Measures);

        $this->set(compact('measures'));
        $this->set('_serialize', ['measures']);
    }

    /**
     * View method
     *
     * @param string|null $id Measure id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $measure = $this->Measures->get($id, [
            'contain' => ['Questions']
        ]);

        $this->set('measure', $measure);
        $this->set('_serialize', ['measure']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $measure = $this->Measures->newEntity();
        if ($this->request->is('post')) {
            $measure = $this->Measures->patchEntity($measure, $this->request->getData());
            if ($this->Measures->save($measure)) {
                $this->Flash->success(__('The measure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The measure could not be saved. Please, try again.'));
        }
        $this->set(compact('measure'));
        $this->set('_serialize', ['measure']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Measure id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $measure = $this->Measures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $measure = $this->Measures->patchEntity($measure, $this->request->getData());
            if ($this->Measures->save($measure)) {
                $this->Flash->success(__('The measure has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The measure could not be saved. Please, try again.'));
        }
        $this->set(compact('measure'));
        $this->set('_serialize', ['measure']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Measure id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $measure = $this->Measures->get($id);
        if ($this->Measures->delete($measure)) {
            $this->Flash->success(__('The measure has been deleted.'));
        } else {
            $this->Flash->error(__('The measure could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
