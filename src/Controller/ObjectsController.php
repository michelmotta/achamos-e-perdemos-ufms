<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Routing\Router;

/**
 * Objects Controller
 *
 * @property \App\Model\Table\ObjectsTable $Objects
 */
class ObjectsController extends AppController
{

    private $userId;
    private $userRole;

    public $helpers = ['TextLimit'];

    /**
     * beforeFilter callback method This callback method allow views to see visualized without authentication
     *
     * @return \Cake\Network\Response|null
     */
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['listAllSolvedObjects', 'listAllUnsolvedObjects', 'singleItem', 'generateDataMaps', 'mapView']);
    }

    /**
     * initialization method of this class
     *
     * @return \Cake\Network\Response|null
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['listAllUnsolvedObjects', 'listAllSolvedObjects']
        ]);
        $this->userId = $this->Auth->user('id');
        $this->userRole = $this->Auth->user('role');
    }

    /**
     * Index method set array of objects to index view
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if($this->userRole == 'admin'){
             $this->paginate = [
                'contain' => ['Users']
            ];
            $objects = $this->paginate($this->Objects);

            $this->set(compact('objects'));
            $this->set('_serialize', ['objects']);
        }else{
            $query = $this->Objects
                ->find()
                ->contain(['Users'])
                ->where(['user_id' => $this->userId]);

            $this->set('objects', $this->paginate($query));
        }
    }

    /**
     * View method search object by id and set data to view
     *
     * @param string|null $id Object id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $object = $this->Objects->get($id, [
            'contain' => ['Users', 'Categories', 'Comments', 'Uploads']
        ]);

        $this->set('object', $object);
        $this->set('_serialize', ['object']);
    }

    /**
     * Add method save a new comment entity to database from frontend form
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $object = $this->Objects->newEntity();
        if ($this->request->is('post')) {

            $object = $this->Objects->patchEntity($object, $this->request->getData());
            if ($this->Objects->save($object)) {
                if(!empty($this->request->data('uploadfile')[0]['tmp_name'])){
                    $objectId = $object->id;

                    $uploadedFiles = $this->Objects->Uploads->uploadMultitpleObjectFiles($this->request->data('uploadfile'));

                    foreach ($uploadedFiles as $uploadedFile) {
                        $upload =  $this->Objects->Uploads->newEntity();

                        $url = Router::url('/', true);
                        $dir = $url . 'webroot' . DS . 'img' . DS . 'uploads' . DS . $uploadedFile;

                        $upload->object_id = $objectId;
                        $upload->user_id = $this->Auth->user('id');
                        $upload->file = $uploadedFile;
                        $upload->file_path = $dir;

                        $this->Objects->Uploads->save($upload);
                    }
                }

                $this->Flash->success(__('O objeto foi salvo com sucesso.'));

                    return $this->redirect(['action' => 'index']);

            }
            $this->Flash->error(__('O objeto não pode ser salvo. Por favor, tente novamente.'));

        }
        $users = $this->Objects->Users->find('list', ['limit' => 200]);
        $categories = $this->Objects->Categories->find('list', ['limit' => 200]);
        $this->set(compact('object', 'users', 'categories'));
        $this->set('_serialize', ['object']);
    }

    /**
     * Edit method edit an existing entity in database
     *
     * @param string|null $id Object id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $object = $this->Objects->get($id, [
            'contain' => ['Categories', 'Uploads']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $object = $this->Objects->patchEntity($object, $this->request->getData());
            if ($this->Objects->save($object)) {
                if(!empty($this->request->data('uploadfile')[0]['tmp_name'])){
                    $objectId = $object->id;

                    $uploadedFiles = $this->Objects->Uploads->uploadMultitpleObjectFiles($this->request->data('uploadfile'));

                    foreach ($uploadedFiles as $uploadedFile) {
                        $upload =  $this->Objects->Uploads->newEntity();
                        $url = Router::url('/', true);
                        $dir = $url . 'webroot' . DS . 'img' . DS . 'uploads' . DS . $uploadedFile;

                        $upload->object_id = $objectId;
                        $upload->user_id = $this->Auth->user('id');
                        $upload->file = $uploadedFile;
                        $upload->file_path = $dir;

                        $this->Objects->Uploads->save($upload);
                    }
                }

                $this->Flash->success(__('O objeto foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O objeto não pode ser salvo. Por favor, tente novamente.'));
        }
        $users = $this->Objects->Users->find('list', ['limit' => 200]);
        $categories = $this->Objects->Categories->find('list', ['limit' => 200]);
        $this->set(compact('object', 'users', 'categories'));
        $this->set('_serialize', ['object']);
    }

    /**
     * Delete method delete an existing entity in database
     *
     * @param string|null $id Object id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $object = $this->Objects->get($id);
        if ($this->Objects->delete($object)) {
            $this->Flash->success(__('O objeto foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O objeto não pôde ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * listAllUnsolvedObjects set array of objects which flag solved = 0
     *
     * @return \Cake\Network\Response|null.
     */
    public function listAllUnsolvedObjects()
    {
        $this->viewBuilder()->setLayout('frontend');

        $objects = $this->Objects
            ->find('search', ['search' => $this->request->query])
            ->order(['Objects.id' => 'DESC'])
            ->where(['solved' => 0])
            ->contain(['Users', 'Categories', 'Comments', 'Uploads']);

        $this->set('objects', $this->paginate($objects));
    }

    /**
     * listAllSolvedObjects set array of objects which flag solved = 1
     *
     * @return \Cake\Network\Response|null.
     */
    public function listAllSolvedObjects()
    {
        $this->viewBuilder()->setLayout('frontend');

        $objects = $this->Objects
            ->find('search', ['search' => $this->request->query])
            ->order(['Objects.id' => 'DESC'])
            ->where(['solved' => 1])
            ->contain(['Users', 'Categories', 'Comments', 'Uploads']);

        $this->set('objects', $this->paginate($objects));
    }

    /**
     * singleItem method This method searchs for data about one single object in the database and set data to the view
     *
     * @return \Cake\Network\Response|null.
     */
    public function singleItem($id = null)
    {
        $this->viewBuilder()->setLayout('frontend');

        $object = $this->Objects->get($id, [
            'contain' => ['Users', 'Categories', 'Comments', 'Uploads'],
        ]);

        $this->set(compact('object', 'users', 'categories'));
        $this->set('_serialize', ['object']);
    }

    /**
     * mapView method This method set frontend layout to view
     *
     * @return \Cake\Network\Response|null.
     */
    public function mapView()
    {
        $this->viewBuilder()->setLayout('frontend');
    }

    /**
     * generateDataMaps method This method set ajax layout, it makes find in Objects database, and set data to view
     *
     * @return \Cake\Network\Response|null.
     */
    public function generateDataMaps()
    {
        $this->autoRender = false;

        $data = $this->Objects->find()
            ->select(['id', 'name', 'type', 'date', 'latitude', 'longitude'])
            ->order(['Objects.id' => 'DESC']);

        $this->response->type('json');

        $json = json_encode($data);

        $this->response->body($json);

    }
}
