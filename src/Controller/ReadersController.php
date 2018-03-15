<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;

/**
 * Readers Controller
 *
 *
 * @method \App\Model\Entity\Reader[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReadersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

   public function beforeFilter(Event $event){
     parent::beforeFilter($event);
     $this->Auth->allow(['add']);
   }

    public function index()
    {
        $this -> viewBuilder() -> layout('admin');

        $readers = $this->paginate($this->Readers);

        $this->set(compact('readers'));
    }

    /**
     * View method
     *
     * @param string|null $id Reader id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this -> viewBuilder() -> layout('admin');

        $reader = $this->Readers->get($id, [
            'contain' => []
        ]);

        $this->set('reader', $reader);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this -> viewBuilder() -> layout('admin');

        $reader = $this->Readers->newEntity();
        if ($this->request->is('post')) {
            $reader = $this->Readers->patchEntity($reader, $this->request->getData());
            if ($this->Readers->save($reader)) {
                $this->Flash->success(__('The reader has been saved.'));
              /*  $email = new Email();
                $email->to('ababaze@gmail.com')
                      ->subject('prona')
                      ->send('My message');*/
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reader could not be saved. Please, try again.'));
        }
        $this->set(compact('reader'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reader id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this -> viewBuilder() -> layout('admin');

        $reader = $this->Readers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $reader = $this->Readers->patchEntity($reader, $this->request->getData());
            if ($this->Readers->save($reader)) {
                $this->Flash->success(__('The reader has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The reader could not be saved. Please, try again.'));
        }
        $this->set(compact('reader'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reader id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $reader = $this->Readers->get($id);
        if ($this->Readers->delete($reader)) {
            $this->Flash->success(__('The reader has been deleted.'));
        } else {
            $this->Flash->error(__('The reader could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
