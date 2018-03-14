<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use SendGrid;


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
      $this->Auth->allow(['add']);
    }
    public function index()
    {
      if($this->Auth->user() != 'null'){
        $current_user = $this->Auth->user();
      }
      if(isset($current_user) && $current_user['role'] == 'admin'){
        $this -> viewBuilder() -> layout('admin');
      }

        $users = $this->paginate($this->Users);

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
      if(isset($current_user) && $current_user['role'] == 'admin'){
        $this -> viewBuilder() -> layout('admin');
      }

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->role='user';
            $user->active=false;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
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
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function login(){
      if(!$this->Auth->user()){
        if($this->request->is('post')){
          $user = $this->Auth->identify();
          if($user){
            $this->Auth->setUser($user);

            Email::configTransport('sendgrid', [
                'host' => 'smtp.sendgrid.net',
                'port' => 587 ,
                'username' => getenv('SENDGRID_USERNAME'),
                'password' => getenv('SENDGRID_PASSWORD'),
                'className' => 'Smtp'
            ]);
            $email = new Email('default');

            $email->from(['ababaze@gmail.com' => 'My Site'])
                ->to('ababaze@gmail.com')
                ->subject('About')
                ->transport('sendgrid', [
                    'host' => 'smtp.sendgrid.net',
                    'port' => 587 ,
                    'username' => getenv('SENDGRID_USERNAME'),
                    'password' => getenv('SENDGRID_PASSWORD'),
                    'className' => 'Smtp'
                ])
                ->send();

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
}
