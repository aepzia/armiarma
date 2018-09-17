<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

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
     $this->Auth->allow(['add','dayEmail','addConfirm','weekEmail','edit']);
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

    public function addConfirm($readerId = null){
      $reader = $this->Readers->get($readerId, [
          'contain' => []
      ]);
      $reader->active = true;
          if ($this->Readers->save($reader)) {

          }
      }
    public function add()
    {
        if($this->Auth->user() != 'null'){
          $current_user = $this->Auth->user();
        }

        if(isset($current_user) && $current_user['role'] == 'admin'){
          $this -> viewBuilder() -> layout('admin');
        }else{
          $this -> viewBuilder() -> layout('user');
        }

        $reader = $this->Readers->newEntity();
        if ($this->request->is('post')) {
            $reader = $this->Readers->patchEntity($reader, $this->request->getData());
            $reader->active= false;
            if ($this->Readers->save($reader)) {
                Email::configTransport('sendgrid',[
                  'host' =>'smtp.sendgrid.net',
                  'port' =>587,
                  'username' => getenv('SENDGRID_USERNAME'),
                  'password' => getenv('SENDGRID_PASSWORD'),
                  'className' => 'Smtp'
                ]);
                $email = new Email('default');
                //BIDALI ATRIBUTU GUZTIK
                $onclick = '<?php echo $this->Html->url(array("controller"=>"Readers","action"=>"add_confirm")) ?>';

               $message = '<p> Zure izen ematea konfirmatzen duzu? </p>';

                $message = $message . "<a href='http://armiarma.herokuapp.com/readers/add_confirm/$reader->id'>
     Konfirmatu</a>";
                $email->from(['ababaze@gmail.com' => 'Armiarma'])
                      ->to($reader->email)
                      ->subject('Izena emana')
                      ->transport('sendgrid')
                      ->emailFormat('html')
                      ->send($message);

                $this->Flash->success(__('Erabiltzailea ondo gorde da.'));
                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('Erabiltzailea ezin izan da ondo gorde. Saia zaitez berriro mesedez.'));
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
                $this->Flash->success(__('Erabiltzailea ondo gorde da.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Erabiltzailea ezin izan da ondo gorde. Saia zaitez berriro mesedez.'));
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
            $this->Flash->success(__('Erabiltzailea ondo gorde da.'));
        } else {
            $this->Flash->error(__('Erabiltzailea ezin izan da ondo gorde. Saia zaitez berriro mesedez.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function weekEmail(){
        $now = Time::now();
        $twoMoth = Time::now();
        $twoMoth->addMonth(2);
        $events = TableRegistry::get('Events')->find('all', [
            'order' => ['hasdata' => 'ASC']
        ]);
        $total = $events->where([
          'bukdata >=' => $now,
          'hasdata <=' => $twoMoth,
          'active' => 1,
          'repeatable' => 0
        ])->count();
        $eventsRepetable = TableRegistry::get('Events')->find('all', [
            'order' => ['hasdata' => 'ASC']
        ]);
        $totalRepetable = $eventsRepetable->where([
          'bukdata >=' => $now,
          'hasdata <=' => $twoMoth,
          'active' => 1,
          'repeatable' => 1
        ])->count();
        if($total>0){
          $this->set('send',true);
          Email::configTransport('sendgrid',[
            'host' =>'smtp.sendgrid.net',
            'port' =>587,
            'username' => getenv('SENDGRID_USERNAME'),
            'password' => getenv('SENDGRID_PASSWORD'),
            'className' => 'Smtp'
          ]);
          $email = new Email('default');

          $email->from(['ababaze@gmail.com' => 'Armiarma']);
          $readers = $this->paginate($this->Readers);
          foreach ($readers as $reader):
            if($reader->maiztasuna == 1 || $reader->maiztasuna == 2 ){
              $email->cc($reader->email)
                    ->subject('Datozten 2 hilabetetako egitaraua')
                    ->transport('sendgrid')
                    ->viewVars(['events' => $events, 'repeatableEvents' => $eventsRepetable, 'totalRepetable' => $totalRepetable, 'readerid'=> $reader->id])
                    ->template('eventsIndexWeek')
                    ->emailFormat('html')
                    ->send();
            }
          endforeach;
        }else{
          $this->set('send',false);
        }
      }
      public function dayEmail(){
        $now = Time::now();
        $twoDays = Time::now();
        $twoDays->addDays(2);
        $events = TableRegistry::get('Events')->find('all', [
            'order' => ['hasdata' => 'ASC']
        ]);
        $total = $events->where([
          'hasdata >' => $now,
          'hasdata <' => $twoDays,
          'active' => 1,
          'repeatable' => 0
        ])->count();
        if($total>0){

          Email::configTransport('sendgrid',[
            'host' =>'smtp.sendgrid.net',
            'port' =>587,
            'username' => getenv('SENDGRID_USERNAME'),
            'password' => getenv('SENDGRID_PASSWORD'),
            'className' => 'Smtp'
          ]);
          $email = new Email('default');
          $email->viewVars(['events' => $events]);

          $email->from(['ababaze@gmail.com' => 'Armiarma']);

          $readers = $this->paginate($this->Readers);
          foreach ($readers as $reader):
            if($reader->maiztasuna == 2){
              $email->cc($reader->email)
                    ->subject('Biharko egitaraua')
                    ->transport('sendgrid')
                    ->viewVars(['events' => $events, 'readerid'=> $reader->id])
                    ->template('eventsIndex')
                    ->emailFormat('html')
                    ->send();
            }
          endforeach;
        }
      }
}
