<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public function beforeFilter(Event $event){
       parent::beforeFilter($event);
       $this->Auth->allow(['indexEmail']);
     }
    public function index()
    {
        if($this->Auth->user() != 'null'){
          $current_user = $this->Auth->user();
        }
        if(isset($current_user) && $current_user['role'] == 'admin'){
          $this -> viewBuilder() -> layout('admin');
        } else if(isset($current_user) && $current_user['role'] == 'user'){
          $this -> viewBuilder() -> layout('erakundea');
        }
        $this->paginate = [
            'contain' => ['Users']
        ];

        if ($current_user['role'] == 'admin'){
          $events = $this->paginate($this->Events->find('all', array('order'=>array('data ASC'))));
        }if($current_user['role'] == 'user'){
          $events = $this->paginate($this->Events->find('all', array('order'=>array('data ASC') , 'conditions' => array('user_id' => $current_user['id']) )));
        }

        $this->set(compact('events'));
    }
    public function indexWeek()
    {

        $events = $this->paginate($this->Events);
        $this->set(compact('events'));
    }
    public function indexDay()
    {

        $events = $this->paginate($this->Events);
        $this->set(compact('events'));
    }

    /**
     * View method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this -> viewBuilder() -> layout('admin');

        $event = $this->Events->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('event', $event);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
      if($this->Auth->user() != 'null'){
        $current_user = $this->Auth->user();
      }
      if(isset($current_user) && $current_user['role'] == 'admin'){
        $this -> viewBuilder() -> layout('admin');

      } else if(isset($current_user) && $current_user['role'] == 'user'){
        $this -> viewBuilder() -> layout('erakundea');

      }
        $event = $this->Events->newEntity();
        if ($this->request->is('post')) {
            $filename = $this->request->data['fitx']['name'];
			      $tmp_name = $this->request->data['fitx']['tmp_name'];
              $isMove=move_uploaded_file($tmp_name,'../webroot/files/Event/file_name/' . $filename );
            $event = $this->Events->patchEntity($event, $this->request->getData());
            $event['fitx']= $filename;
            if($current_user['role'] == 'user'){
              $event['user_id'] =$current_user['id'];
              $event['active'] =false;
            }

            if ($this->Events->save($event)) {
                $this->Flash->success(__('The event has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The event could not be saved. Please, try again.'));
        }
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this -> viewBuilder() -> layout('admin');

        $event = $this->Events->get($id, [
            'contain' => []
        ]);

          if ($this->request->is(['patch', 'post', 'put'])) {

            if (empty($this->request->data['fitx']['name'])) {
                $file = $event['fitx'];
                $event= $this->Events->patchEntity($event, $this->request->getData());
                $event['fitx'] = $file;
            } else {
              $filename = $this->request->data['fitx']['name'];
  			      $tmp_name = $this->request->data['fitx']['tmp_name'];
                $isMove=move_uploaded_file($tmp_name,'../webroot/files/Event/file_name/' . $filename );
              $event = $this->Events->patchEntity($event, $this->request->getData());
              $event['fitx']= $filename;
            }
            /*if ($this->request->is(['patch', 'post', 'put'])) {
              $file = $this->request->data['fitx'];

                $filename = $this->request->data['fitx']['name'];
    			      $tmp_name = $this->request->data['fitx']['tmp_name'];
                $isMove=move_uploaded_file($tmp_name,'../webroot/files/Event/file_name/' . $filename );
                $new_event = $this->Events->patchEntity($new_event, $this->request->getData());*/
                /*$tmp_name = $this->request->data['fitx']['tmp_name'];
                $isMove=move_uploaded_file($tmp_name,'../webroot/files/Event/file_name/' . $filename );
                if($isMove){
                  $this->Flash->error(__("The event could not be saved. Please, try again. true"));
                }else{
                  $this->Flash->error(__("The event could not be saved. Please, try again. false $filename $tmp_name"));
                }*/

                if ($this->Events->save($event)) {
                    $this->Flash->success(__('The event has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("The event could not be saved. Please, try again."));

        }
        $users = $this->Events->Users->find('list', ['limit' => 200]);
        $this->set(compact('event', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
