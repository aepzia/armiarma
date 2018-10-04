<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;


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
        $now = Time::now();

        if ($current_user['role'] == 'admin'){
          $events = $this->paginate($this->Events->find('all', array('order'=>array('hasdata ASC') , 'conditions' => array(
                'bukdata >=' => $now,
            ) )));        }if($current_user['role'] == 'user'){
          $events = $this->paginate($this->Events->find('all', array('order'=>array('hasdata ASC') , 'conditions' => array(
            'bukdata >=' => $now,
              'or' => array(
                'bukdata >=' => $now,
                'user_id' => $current_user['id'],
                'events.active' =>1
              )
            ) )));
        }
        $this->set(compact('events'));
    }

    public function indexNireak()
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
        $now = Time::now();

        if (isset($current_user)){
          $events = $this->paginate($this->Events->find('all', array('order'=>array('hasdata ASC') , 'conditions' => array(
                'user_id' => $current_user['id'],
                'events.active' =>1
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
        $user = $this->Events->Users->get($event->user_id);
        $this->set('event', $event);
        $this->set('user', $user);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
     public function deleteConfirm($eventId = null){
       $event = $this->Events->get($eventId, [
           'contain' => ['Users']
       ]);
       //hilabete bat baino lehenago ezeztatu bada emailez bidali denei.
         $month= Time::now();
         $now= Time::now();
         $month->addMonth(1);
         if($event['active'] ==1 && $event['hasdata'] < $month && $event['hasdata'] > $now){
           //emaila bidali
           $readers = TableRegistry::get('Readers')->find('all', [
               'order' => ['email' => 'ASC']
           ]);
             Email::configTransport('sendgrid',[
               'host' =>'smtp.sendgrid.net',
               'port' =>587,
               'username' => getenv('SENDGRID_USERNAME'),
               'password' => getenv('SENDGRID_PASSWORD'),
               'className' => 'Smtp'
             ]);
             $email = new Email('default');

             $email->from(['ababaze@gmail.com' => 'Armiarma']);

             foreach ($readers as $reader):
                 $email->cc($reader->email)
                       ->subject('Ekitaldi ezeztatua')
                       ->transport('sendgrid')
                       ->viewVars(['event' => $event, 'readerid'=> $reader->id])
                       ->template('eventsDeleted')
                       ->emailFormat('html')
                       ->send();
             endforeach;

         }
       $this->Events->delete($event);
     }

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

            if(isset($current_user) && $current_user['role'] == 'user'){
              $event['user_id'] =$current_user['id'];
              $event['active'] =false;
            }

            if ($this->Events->save($event)) {

              Email::configTransport('sendgrid',[
                'host' =>'smtp.sendgrid.net',
                'port' =>587,
                'username' => getenv('SENDGRID_USERNAME'),
                'password' => getenv('SENDGRID_PASSWORD'),
                'className' => 'Smtp'
              ]);
              $email = new Email('default');
              //BIDALI ATRIBUTU GUZTIK
              $email->from(['ababaze@gmail.com' => 'Armiarma'])
                    ->to($current_user['email'])
                    ->subject('Ekitaldi berria')
                    ->transport('sendgrid')
                    ->viewVars(['event' => $event])
                    ->template('eventsAdd')
                    ->emailFormat('html')
                    ->send();

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

        $previousEvent = $this->Events->get($id, [
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
                    if($previousEvent->active == 0 && $event['active'] == 1){
                      //Administratzaileak ekitaldia onartu du
                      $now = Time::now();
                      $nextDay = Time::now();
                     if ($now->day > 1 && $now->day < 15) {
                        //lehenengo hamabostaldia: hurrengo emaila 15ean:
                        $nextDay->day = 15;
                      }else{
                        //bgarren hamabostaldia: hurrengo emaila hurrengo hilabeteko 1ean:
                        $nextDay->addMonth(1);
                        $nextDay->day =1;
                      }
                      //ekitaldiaren hasiera hurrengo emaila baina lehenago bada:
                      if($event['hasdata'] < $nextDay){
                        //emaila bidali
                        $readers = TableRegistry::get('Readers')->find('all', [
                            'order' => ['email' => 'ASC']
                        ]);

                          Email::configTransport('sendgrid',[
                            'host' =>'smtp.sendgrid.net',
                            'port' =>587,
                            'username' => getenv('SENDGRID_USERNAME'),
                            'password' => getenv('SENDGRID_PASSWORD'),
                            'className' => 'Smtp'
                          ]);
                          $email = new Email('default');

                          $email->from(['ababaze@gmail.com' => 'Armiarma']);

                          foreach ($readers as $reader):
                            $email->cc($reader->email)
                                    ->subject('Azken ordukoa')
                                    ->transport('sendgrid')
                                    ->viewVars(['event' => $event, 'readerid'=> $reader->id])
                                    ->template('eventsLast')
                                    ->emailFormat('html')
                                    ->send();
                         endforeach;

                     }
                   }

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
        //erabiltzailera admina edo arduraduna da
        if($this->Auth->user() != 'null'){
          $current_user = $this->Auth->user();
        }
        if(isset($current_user) && ($current_user['role'] == 'admin' || $current_user['id'] == $event->user_id) ) {
          //Emailez konfirmatu
          Email::configTransport('sendgrid',[
            'host' =>'smtp.sendgrid.net',
            'port' =>587,
            'username' => getenv('SENDGRID_USERNAME'),
            'password' => getenv('SENDGRID_PASSWORD'),
            'className' => 'Smtp'
          ]);
          $email = new Email('default');
          //BIDALI ATRIBUTU GUZTIK
          $email->from(['ababaze@gmail.com' => 'Armiarma'])
                ->to($current_user['email'])
                ->subject('Ekitaldia ezeztatu')
                ->transport('sendgrid')
                ->viewVars(['event' => $event])
                ->template('eventsDelete')
                ->emailFormat('html')
                ->send();
        }
        return $this->redirect(['action' => 'index']);
    }
}
