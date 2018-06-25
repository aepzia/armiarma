<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use SendGrid;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;


/**
 * Users Controller
 *
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */

    public function beforeFilter(Event $event){
      parent::beforeFilter($event);
      $this->Auth->allow(['add','adminEmail']);
    }
    public function index()
    {
      if($this->Auth->user() != 'null'){
        $current_user = $this->Auth->user();
      }
      if(isset($current_user) && $current_user['role'] == 'admin'){
        $this -> viewBuilder() -> layout('admin');
        $users = $this->paginate($this->Users);

      }


        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
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

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
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
      }

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            if($this->request->data['password'] == $this->request->data['password2']){
              $user = $this->Users->patchEntity($user, $this->request->getData());
              $user->role='user';
              $user->active=false;
              if ($this->Users->save($user)) {
                  Email::configTransport('sendgrid',[
                    'host' =>'smtp.sendgrid.net',
                    'port' =>587,
                    'username' => getenv('SENDGRID_USERNAME'),
                    'password' => getenv('SENDGRID_PASSWORD'),
                    'className' => 'Smtp'
                  ]);
                  $email = new Email('default');

                  $email->from(['ababaze@gmail.com' => 'Armiarma'])
                        ->to($user->email)
                        ->subject('Izena emana')
                        ->transport('sendgrid')
                        ->send('Zure erabiltzailea gorde da. Administratzaileak erabiltzailea onartzerakoan jasoko duzu abisua.');

                  $this->Flash->success(__('Erabiltzailea ondo gorde gorde da.'));

                  if(isset($current_user) && $current_user['role'] == 'admin'){
                    return $this->redirect(['action' => 'index']);
                  }else {
                    return $this->redirect(['action' => 'login']);
                  }
              }
              $this->Flash->error(__('Erabiltzailea ezin izan da ondo gorde. Saia zaitez berriro mesedez.'));
            }else{
              $this->Flash->error(__('Pasahitzek ez dute koinziditzen. Saia zaitez berriro mesedez.'));
            }
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $previousEmail = $user->email;
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
              Email::configTransport('sendgrid',[
                'host' =>'smtp.sendgrid.net',
                'port' =>587,
                'username' => getenv('SENDGRID_USERNAME'),
                'password' => getenv('SENDGRID_PASSWORD'),
                'className' => 'Smtp'
              ]);
              $email = new Email('default');

              $email->from(['ababaze@gmail.com' => 'Armiarma'])
                    ->to($previousEmail)
                    ->subject('Izena emana')
                    ->transport('sendgrid')
                    ->send('Zure erabiltzaileko datu berriak gorde dira. Ez bazara zu izan mesedez jarri administratzailearekin harremanetan');

                $this->Flash->success(__('Erabiltzailea ondo gorde da.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erabiltzailea ezin izan da ondo gorde. Saia zaitez berriro mesedez.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('Erabiltzailea ezabatu da.'));
        } else {
            $this->Flash->error(__('Erabiltzailea ezin izan da ezabatu. Saia zaitez berriro mesedez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function login(){
      if(!$this->Auth->user()){
        if($this->request->is('post')){
          $user = $this->Auth->identify();

          if($user && $user['active']){
            $this->Auth->setUser($user);

            return $this->redirect($this->Auth->redirectUrl());
          }
          $this->Flash->error('Erabiltzaile edo pasahitz okerra, mesedez saia zaitez berriro.');
        }
      }else{
        $this->redirect($this->Auth->redirectUrl());
      }
    }
    public function logout(){
      return $this->redirect($this->Auth->logout());
    }
    public function adminEmail(){
      $today = Time::now();
      $yesterday = Time::now();
      $yesterday->subDays(2);
      $events = TableRegistry::get('Events')->find();
      $totalEvents = $events->where([
        'modified >' => $yesterday,
        'modified <' => $today
      ])->count();
      $users = TableRegistry::get('Users')->find();
      $totalUsers = $users->where([
        'modified >' => $yesterday,
        'modified <' => $today
      ])->count();
      $total = $totalEvents + $totalUsers;

      if($total>0){

        Email::configTransport('sendgrid',[
          'host' =>'smtp.sendgrid.net',
          'port' =>587,
          'username' => getenv('SENDGRID_USERNAME'),
          'password' => getenv('SENDGRID_PASSWORD'),
          'className' => 'Smtp'
        ]);
        $email = new Email('default');

        $email->from(['ababaze@gmail.com' => 'Armiarma']);

        $users= $this->paginate($this->Users);
        foreach ($users as $user):
          if($user->role == 'admin'){
            $email->cc($user->email)
                  ->subject('Eguneraketak')
                  ->transport('sendgrid')
                  ->template('news')
                  ->emailFormat('html')
                  ->send();
          }
        endforeach;
      }
    }
    public function sendEmail(){
      if($this->Auth->user() != 'null'){
        $current_user = $this->Auth->user();
      }
      if(isset($current_user) && $current_user['role'] == 'admin'){
        $this -> viewBuilder() -> layout('admin');
      } else if(isset($current_user) && $current_user['role'] == 'user'){
        $this -> viewBuilder() -> layout('erakundea');
      }
      $readers = TableRegistry::get('Readers')->find();

      if($this->request->data['subject'] == 1){
        $subject = 'Hendaiako euskal hizkuntza politikari loturiko informazioa'
        $total = $readers->where([
          'hizkuntzapolitikainfo' => 1,
        ])->count();
      }else if($this->request->data['subject'] == 2){
        $subject = 'Euskaraldiko (“Aho bizi / Belarri prest”) ekimenari buruzko informazioa'
        $total = $readers->where([
          'ahobizi' => 1,
        ])->count();
      }else if($this->request->data['subject'] == 3){
        $subject = 'Euskararen aldeko ekimenetan, bolondres modura aritzeko informazioa'
        $total = $readers->where([
          'bolondres' => 1,
        ])->count();
      }

      if($total>0){

        Email::configTransport('sendgrid',[
          'host' =>'smtp.sendgrid.net',
          'port' =>587,
          'username' => getenv('SENDGRID_USERNAME'),
          'password' => getenv('SENDGRID_PASSWORD'),
          'className' => 'Smtp'
        ]);
        $email = new Email('default');

        $email->from($current_user->email);

        $email->cc('ababaze@gmail.com')
              ->subject($subject)
              ->transport('sendgrid')
              ->viewVars(['message' => $this->request->data['message'], 'readerid'=> 1])
              ->template('topic')
              ->emailFormat('html')
              ->send();
        /*foreach ($readers as $reader):
            $email->cc($reader->email)
                  ->subject($subject)
                  ->transport('sendgrid')
                  ->viewVars(['message' => $this->request->data['message'], 'readerid'=> $reader->id])
                  ->template('topic')
                  ->emailFormat('html')
                  ->send();
        endforeach;*/
      }
    }
}
