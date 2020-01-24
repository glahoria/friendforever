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

    public $thumb = null;
    public $fileName = null;
    public $actualWidth = null;
    public $actualHeight = null;
    public $fileExt = null;
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
                'Likes' => function ($q) { return $q->where(['Likes.user_id' => $this->Auth->user('id')]); },
                'PostImages'=>['Images']
            ])
            ->order(['Posts.created' => 'DESC'])->all();
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
        $this->set('post', $post);
    }

    public function save() {
        $status = "Not Saved";
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {

            $post = $this->Posts->patchEntity($post, $this->request->getData());
            //pr($this->request->getData()); die;
            $post->user_id = $this->Auth->user('id');
                 //pr($post); die;
            if ($this->Posts->save($post)) {

                if (!empty($this->getRequest()->getData('image_data'))) {


                    $this->loadModel('Images');

                    $image = $this->Images->newEntity();
                    $this->fileExt = explode("/", $this->getRequest()->getData('image_type'))[1];
                    $this->fileName = uniqid() . "." . $this->fileExt;
                    $filePath = WWW_ROOT . 'files/images/' . $this->fileName;
                    $imageUrl = SITE_URL . 'files/images/' . $this->fileName;

                    $ifp = fopen($filePath, 'wb');

                    // we could add validation here with ensuring count( $this->getRequest()->getData('image_data') ) > 1
                    $data = explode( ',', $this->getRequest()->getData('image_data') );
                    fwrite($ifp, base64_decode($data[ 1 ]));

                    // clean up the file resource
                    fclose($ifp);

                    $image->image = 'files/images/' . $this->fileName;
                    $image->user_id = ($this->Auth->user()) ? $this->Auth->user('id') : 0;

                    $image->category = "Post";
                    $image->status = true;

                    $this->loadComponent('Thumb');
                    $this->thumb = $this->Thumb;

                    list($this->actualWidth, $this->actualHeight) = getimagesize($imageUrl);


                    $this->createThumb('small', SMALL_THUMB_WIDTH);
                    $this->createThumb('medium', MEDIUM_THUMB_WIDTH);
                    $this->createThumb('large', LARGE_THUMB_WIDTH);

                    if($this->Images->save($image)) {
                        $this->loadModel('PostImages');

                        $postImages = $this->PostImages->newEntity();

                        $postImages->post_id = $post->id;
                        $postImages->image_id = $image->id;

                        $this->PostImages->save($postImages);
                    }
                }

                $post = $this->Posts->find()
                    ->contain([
                        'Users',
                        'Likes' => function ($q) { return $q->where(['Likes.user_id' => $this->Auth->user('id')]); },
                        'PostImages'=>['Images']
                        ])
                    ->where(['Posts.id' => $post->id])->first();
            }
        }
        echo json_encode(['post' => $post, 'status' => $status]);
        exit;
    }

    public function createThumb($thumbName = "small", $newWidth) {
        $imageUrl = SITE_URL . 'files/images/' . $this->fileName;
        $thumbPath = WWW_ROOT . 'files/images/thumbs/';

        $newHeight = $newWidth * ($this->actualHeight / $this->actualWidth);
        $options = ['destinationPath' => $thumbPath, 'image' => ['type' => "image/" . ((in_array(strtolower($this->fileExt), ['jpg', 'jpeg'])) ? "jpeg" : "png")], 'tmpname' => $imageUrl, 'name' => $thumbName . "_" . $this->fileName, 'width' => $newWidth, 'argHeight' => $newHeight];
        $this->thumb->create($options);

        return 'files/images/thumbs/' . $thumbName . "_" . $this->fileName;
    }


    /**
     * Edit method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $post = $this->Posts->get($id, ['contain' => ['PostImages'=>'Images']]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $post = $this->Posts->patchEntity($post, $this->request->getData());
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
     * Delete method
     *
     * @param string|null $id Post id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $post = $this->Posts->get($id);
        $this->Posts->delete($post);

        $this->loadModel('Comments');
        $this->Comments->deleteAll(['post_id'=>$id]);

        $this->loadModel('PostImages');
        $this->PostImages->deleteAll(['post_id'=>$id]);

        $this->loadModel('Likes');
        $this->Likes->deleteAll(['post_id'=>$id]);

        echo json_encode(['status'=>'deleted']);
        exit;

    }
    public function imageDelete($id) {
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('PostImages');
        $postImage = $this->PostImages->get($id);
        $this->PostImages->delete($postImage);

        echo json_encode(['status'=>'deleted']);
        exit;

    }

    public function like() {
        $this->loadModel('Likes');

        $postLike = $this->Likes->find()->where(['Likes.post_id' => $this->getRequest()->getData('post_id'), 'Likes.user_id' => $this->Auth->user('id')])->first();
        if (empty($postLike)) {
            $postLike = $this->Likes->newEntity();
        }

        $postLike->post_id = $this->getRequest()->getData('post_id');
        $postLike->user_id = $this->Auth->user('id');
        $postLike->like_type = $this->getRequest()->getData('action') == 'like' ? true : false;


        $this->Likes->save($postLike);


        echo json_encode(['current_status' => $this->getRequest()->getData('action') . "d"]);
        exit;
    }

    public function comment() {
        $status = "Not Saved";
        $this->loadModel('Comments');
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            //pr($comment); die;
            $comment->post_id = $this->getRequest()->getData('post_id');
            $comment->user_id = $this->Auth->user('id');
            if ($this->Comments->save($comment)) {
                $comment = $this->Comments->find()->contain(['Users'])->where(['Comments.id' => $comment->id])->first();
            }
        }
        echo json_encode(['comment' => $comment, 'status' => $status]);
        exit;
    }

    public function getComments($postId) {
        $this->loadModel('Comments');

        $comments = $this->Comments->find()->contain(['Users'])->where(['Comments.post_id' => $postId])->order(['Comments.created' => 'ASC'])->all();
        echo json_encode(['comments' => $comments]);
        exit;
    }
}
