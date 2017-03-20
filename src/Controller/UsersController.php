<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    /**
     * beforeFilter callback method
     * This callback method allow views to see visualized without authentication
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // Allow AuthComponent methods.
        $this->Auth->allow(['logout', 'register', 'viewProfile']);
    }

    /**
     * login method
     * This permits users to login at this application
     * @return \Cake\Network\Response|null
     */
    public function login()
    {
        $this->viewBuilder()->layout('login');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Usuário ou senha inválidos, tente novamente.'));
        }
    }

    /**
     * login method
     * This permits users to logout at this application
     * @return \Cake\Network\Response|null
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * Index method
     * This method set data from users to the view
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $userId = $this->Auth->user('id');
        $userRole = $this->Auth->user('role');

        if($userRole == 'admin'){
            $this->paginate = [
                'contain' => []
            ];
            $users = $this->paginate($this->Users);

            $this->set(compact('users'));
            $this->set('_serialize', ['users']);
        }else{
            $query = $this->Users
            ->find()
            ->where(['Users.id' => $userId]);

            $this->set('users', $this->paginate($query));
        }

        
    }

    /**
     * View method
     * 
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Objects']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     * This method saves one user entity data from add view
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            if(!empty($arr['tmp_name'])){
                $this->loadModel('Uploads');
                $file = $this->Uploads->uploadUserSingleFile($this->request->data('photo'));

                $url = Router::url('/', true);
                $dir = $url . 'webroot' . DS . 'img' . DS . 'users' . DS . $file;
                
                $user->photo = $file;
                $user->photo_path = $dir;
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('O usuário foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     * This method saves one user entity data from register view
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function register()
    {
        $this->viewBuilder()->setLayout('frontend');

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
            $arr = $this->request->data('photo');
            if(!empty($arr['tmp_name'])){
                $this->loadModel('Uploads');
                $file = $this->Uploads->uploadUserSingleFile($this->request->data('photo'));

                $url = Router::url('/', true);
                $dir = $url . 'webroot' . DS . 'img' . DS . 'users' . DS . $file;
                
                $user->photo = $file;
                $user->photo_path = $dir;
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('Sua conta foi criada com sucesso.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('Sua conta não pôde ser criada. Por favor, tente novamente.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $arr = $this->request->data('photo');
            
            if($arr['tmp_name'] == ''){
                 unset($this->request->data['photo']);
            }

            $user = $this->Users->patchEntity($user, $this->request->getData());

            if(!empty($arr['tmp_name'])){
                $this->loadModel('Uploads');
                $file = $this->Uploads->uploadUserSingleFile($this->request->data('photo'));

                $url = Router::url('/', true);
                $dir = $url . 'webroot' . DS . 'img' . DS . 'users' . DS . $file;
                
                $user->photo = $file;
                $user->photo_path = $dir;
            }
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('O usuário foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O usuário não pôde ser salvo. Por favor, tente novamente.'));
        }
        unset($user->password);
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('O usuário foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O usuário não pôde ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * viewProfile method
     * @param string|null $id User id.
     * This method set data from single user to the view
     * @return \Cake\Network\Response|null
     */
    public function viewProfile($id = null)
    {
        $this->viewBuilder()->setLayout('frontend');

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }
}
