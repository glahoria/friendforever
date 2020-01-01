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
class PostsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
      // public  $name = 'post';
      // public  $components = array('RequestHandler'); 
    public function index()
     {
         $this->paginate = [
             'contain' => ['Users']
         ];
         $posts = $this->paginate($this->Posts);

         $this->set(compact('posts'));
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
    public function view($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => ['Users', 'Comments', 'Likes']
        ]);

        $this->set('post', $post);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
     {
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
    // public function wall()
    //   {
    //        $this->autoRender=false;
    // if($this->RequestHandler->isAjax()){
    //    Configure::write('debug', 0);
    // }
    //   if(!empty($this->data)){
    //      if($this->Posts->save($this->data)){  
    //    echo 'Record has been added';
    //      }else{
    //        echo 'Error while adding record';
    //      }
    //   }
    //       $users = $this->Posts->Users->find('list', ['limit' => 200]);
    //       $this->set(compact('post', 'users'));
    //   }
    public function wall()
      {
         $post = $this->Posts->newEntity();
         if ($this->request->is('post')) {
             $post = $this->Posts->patchEntity($post, $this->request->getData());
             //pr($post); die;
             $post->user_id = $this->Auth->user('id');
            if ($this->Posts->save($post)) {
                 $this->Flash->success(__('The post has been saved.'));

                 return $this->redirect(['action' => 'wall']);
             }
             $this->Flash->error(__('The post could not be saved. Please, try again.'));
         }
         $users = $this->Posts->Users->find('list', ['limit' => 200]);
         $this->set(compact('post', 'users'));
     }

    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $post = $this->Posts->get($id, [
            'contain' => []
        ]);
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
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
