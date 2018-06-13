<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;

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
       $this->Auth->allow(['view']);
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
          $events = $this->paginate($this->Events->find('all', array('order'=>array('hasdata ASC'))));
        }if($current_user['role'] == 'user'){
          $events = $this->paginate($this->Events->find('all', array('order'=>array('hasdata ASC') , 'conditions' => array(
              'or' => array(
                'user_id' => $current_user['id'],
                'events.active' => 1
              )
            ) )));
        }

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
        if($this->Auth->user() != 'null'){
          $current_user = $this->Auth->user();
        }
        if(isset($current_user) && $current_user['role'] == 'admin'){
          $this -> viewBuilder() -> layout('admin');
        } else if(isset($current_user) && $current_user['role'] == 'user'){
          $this -> viewBuilder() -> layout('erakundea');
        }
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
            $event = $this->Events->patchEntity($event, $this->request->getData());
            if($filename == ''){
              $event['fitx']= 'https://res.cloudinary.com/hemnovybo/image/upload/v1527109103/descarga_1.png';
            }else{
              $result = \Cloudinary\Uploader::upload($this->request->data['fitx']['tmp_name'], array("use_filename" => TRUE));
              $event['fitx']= $result['url'];
            }

            if($current_user['role'] == 'user'){
              $event['user_id'] =$current_user['id'];
              $event['active'] =false;
            }

            if ($this->Events->save($event)) {
                $this->Flash->success(__('Ekitaldia ondo gorde da.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Ekitaldia ezin izan da gorde. Saia zaitez berriro mesedez.'));
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
        if($this->Auth->user() != 'null'){
          $current_user = $this->Auth->user();
        }
        if(isset($current_user) && $current_user['role'] == 'admin'){
          $this -> viewBuilder() -> layout('admin');

        } else if(isset($current_user) && $current_user['role'] == 'user'){
          $this -> viewBuilder() -> layout('erakundea');

        }

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
              $event = $this->Events->patchEntity($event, $this->request->getData());
              $result = \Cloudinary\Uploader::upload($this->request->data['fitx']['tmp_name'], array("use_filename" => TRUE));
              $event['fitx']= $result['url'];
            }

                if ($this->Events->save($event)) {
                    $this->Flash->success(__('Ekitaldia ondo gorde da.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(__("Ekitaldia ezin izan da gorde. Saia zaitez berriro mesedez."));

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
            $this->Flash->success(__('Ekitaldia ondo gorde da.'));
        } else {
            $this->Flash->error(__('Ekitaldia ezin izan da gorde. Saia zaitez berriro mesedez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
