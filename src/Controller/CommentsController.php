<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 */
class CommentsController extends AppController
{

    private $userId;
    private $userRole;

    public function initialize()
    {
        parent::initialize();

        $this->userId = $this->Auth->user('id');
        $this->userRole = $this->Auth->user('role');
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {

        if($this->userRole == 'admin'){
            $this->paginate = [
                'contain' => ['Objects']
            ];
            $comments = $this->paginate($this->Comments);

            $this->set(compact('comments'));
            $this->set('_serialize', ['comments']);

        }else{
            $query = $this->Comments
                ->find()
                ->contain(['Objects'])
                ->where(['Objects.user_id' => $this->userId]);

            $this->set('comments', $this->paginate($query));
        }
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Objects']
        ]);

        $comment->status = 1; 

        if($this->Comments->save($comment)){
            $comment = $this->Comments->get($id, [
                'contain' => ['Objects']
            ]);
        }
        
        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    
    /**
     * addComment
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addComment()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('O comentário foi salvo com sucesso.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('O comentário não pôde ser salvo. Por favor, tente novamente.'));
        }
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('O comentário foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O comentário não pôde ser salvo. Por favor, tente novamente.'));
        }
        $objects = $this->Comments->Objects->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'objects'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('O comentário foi salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O comentário não pôde ser salvo. Por favor, tente novamente.'));
        }
        $objects = $this->Comments->Objects->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'objects'));
        $this->set('_serialize', ['comment']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('O comentário foi deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O comentário não pôde ser deletado. Por favor, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
