<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Posts Controller
 *
 * @property \App\Model\Table\PostsTable $Posts
 *
 * @method \App\Model\Entity\Post[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PostsController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    // public  $name = 'post';
    // public  $components = array('RequestHandler');
    public function index() {
        $this->paginate = ['contain' => ['Users']];
        $posts = $this->paginate($this->Posts);

        $this->set(compact('posts'));
    }


    public function getPosts() {
        $posts = $this->Posts->find()
            ->contain([
                'Users',
                'Likes'=>function($q){ return $q->where(['Likes.user_id'=>$this->Auth->user('id')]); }
            ])
            ->order(['Posts.created'=>'DESC'])
            ->all();
        echo json_encode(['posts' => $posts]);
        exit;
    }
    //  public function wall(){
    //    $this->layout='post';
    // }

    /**
     * View method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $post = $this->Posts->get($id, ['contain' => ['Users', 'Comments', 'Likes']]);

        $this->set('post', $post);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    public function wall() {




        $post = $this->Posts->newEntity();
        $this->set('post',$post);
    }

    public function save() {
        $status = "Not Saved";
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            //pr($post); die;
            $post->user_id = $this->Auth->user('id');
            if ($this->Posts->save($post)) {
                $post = $this->Posts->find()->contain(['Users'])->where(['Posts.id' => $post->id])->first();
            }
        }
        echo json_encode(['post' => $post, 'status' => $status]);
        exit;
    }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $post = $this->Posts->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
            if ($this->Posts->save($post)) {
                $this->Flash->success(__('The post has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The post could not be saved. Please, try again.'));
        }
        $users = $this->Posts->Users->find('list', ['limit' => 200]);
        $this->set(compact('post', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function like(){
        $this->loadModel('Likes');

        $postLike = $this->Likes->find()
            ->where([
                'Likes.post_id'=>$this->getRequest()->getData('post_id'),
                'Likes.user_id'=>$this->Auth->user('id')
            ])
            ->first();
        if(empty($postLike)){
            $postLike = $this->Likes->newEntity();
        }

        $postLike->post_id = $this->getRequest()->getData('post_id');
        $postLike->user_id = $this->Auth->user('id');
        $postLike->like_type = $this->getRequest()->getData('action') == 'like' ? true :false;


        $this->Likes->save($postLike);


        echo json_encode(['current_status'=>$this->getRequest()->getData('action')."d"]);
        exit;
    }
}
