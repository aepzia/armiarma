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
     $this->Auth->allow(['add','email']);
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
        if($this->Auth->user() != 'null'){
          $current_user = $this->Auth->user();
        }
        if(isset($current_user) && $current_user['role'] == 'admin'){
          $this -> viewBuilder() -> layout('admin');
        }

        $reader = $this->Readers->newEntity();
        if ($this->request->is('post')) {
            $reader = $this->Readers->patchEntity($reader, $this->request->getData());
            if ($this->Readers->save($reader)) {
                Email::configTransport('sendgrid',[
                  'host' =>'smtp.sendgrid.net',
                  'port' =>587,
                  'username' => getenv('SENDGRID_USERNAME'),
                  'password' => getenv('SENDGRID_PASSWORD'),
                  'className' => 'Smtp'
                ]);
                $email = new Email('default');

                $email->from(['ababaze@gmail.com' => 'Armiarma'])
                      ->to($reader->email)
                      ->subject('Izena emana')
                      ->transport('sendgrid')
                      ->send('Zure erabiltzailea gorde da, hemendik aurrera euskararen inguruko ekintzen informazioa jasoko duzu.');

                $this->Flash->success(__('The reader has been saved.'));
                return $this->redirect(['action' => 'add']);
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
    public function email(){
        Email::configTransport('sendgrid',[
          'host' =>'smtp.sendgrid.net',
          'port' =>587,
          'username' => getenv('SENDGRID_USERNAME'),
          'password' => getenv('SENDGRID_PASSWORD'),
          'className' => 'Smtp'
        ]);
        $email = new Email('default');

        $message = file_get_contents('http://armiarma.herokuapp.com/events/index');
        $email->from(['ababaze@gmail.com' => 'Armiarma'])
              ->to('ababaze@gmail.com')
              ->subject('boletina')
              ->transport('sendgrid')
              ->emailFormat('html')
              ->send($message);
      }
}
