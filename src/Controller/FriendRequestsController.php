<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * FriendRequests Controller
 *
 * @property \App\Model\Table\FriendRequestsTable $FriendRequests
 *
 * @method \App\Model\Entity\FriendRequest[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FriendRequestsController extends AppController {
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $this->paginate = ['contain' => ['Users', 'Users'],];
        $friendRequests = $this->paginate($this->FriendRequests);

        $this->set(compact('friendRequests'));
    }

    public function friends() {

    }

    public function getFriends() {
        $currentUserId = $this->Auth->user('id');
        $execptUsers[] = $currentUserId;
        $this->loadModel('Friends');
        $friends = $this->Friends->find()->where(['Friends.user_id' => $currentUserId])->all();
        if (!empty($friends)) {
            foreach ($friends as $friend) {
                $execptUsers[] = $friend->friend_id;
            }
        }

        $friendRequests = $this->FriendRequests->find()->where(['OR' => ['FriendRequests.request_to_id' => $currentUserId, 'FriendRequests.request_from_id' => $currentUserId]])->count();

        $friendRequests = $this->FriendRequests->find()->where(['FriendRequests.request_to_id' => $currentUserId])->first();
        if (!empty($friendRequests)) {
            foreach ($friendRequests as $friendRequest) {
                $execptUsers[] = $friendRequest->request_from_id;
            }
        }

        $friendRequests = $this->FriendRequests->find()->where(['FriendRequests.request_from_id' => $currentUserId])->first();
        if (!empty($friendRequests)) {
            foreach ($friendRequests as $friendRequest) {
                $execptUsers[] = $friendRequest->request_to_id;
            }
        }


        //        if (empty($friends)) {
        $key = $this->request->getQuery('friend_search');
        $this->loadModel('Users');


        $users = $this->Users->find()->where(['Users.id NOT IN' => $execptUsers, 'OR' => ['first_name LIKE' => '%' . $key . '%', 'last_name LIKE' => '%' . $key . '%']])->all();
        //        }
        echo json_encode(['users' => $users]);
        exit;
    }

    /**
     * View method
     *
     * @param string|null $id Friend Request id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $friendRequest = $this->FriendRequests->get($id, ['contain' => ['Users', 'Users'],]);

        $this->set('friendRequest', $friendRequest);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $friendRequest = $this->FriendRequests->newEntity();
        if ($this->request->is('post')) {
            $friendRequest = $this->FriendRequests->patchEntity($friendRequest, $this->request->getData());
            if ($this->FriendRequests->save($friendRequest)) {
                $this->Flash->success(__('The friend request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The friend request could not be saved. Please, try again.'));
        }
        $requestFroms = $this->FriendRequests->Users->find('list', ['limit' => 200]);
        $requestTos = $this->FriendRequests->Users->find('list', ['limit' => 200]);
        $this->set(compact('friendRequest', 'Users', 'Users'));
    }

    //    public function friends()
    //    {
    //        $friendRequest = $this->FriendRequests->newEntity();
    //        $this->set('post', $friendRequest);
    //
    //
    //    }

    public function sendRequest() {
        $friendRequest = $this->FriendRequests->newEntity();
        if ($this->request->is('post')) {
            $friendRequest = $this->FriendRequests->patchEntity($friendRequest, $this->request->getData());
            $friendRequest->request_from_id = $this->Auth->user('id');
            $friendRequest->status = "Pending";
            if ($this->FriendRequests->save($friendRequest)) {
                if ($this->FriendRequests->save($friendRequest)) {
                   $friendRequest = $this->FriendRequests->find()->contain(['Users'])->where(['FriendRequests.id' => $friendRequest->id])->first();
                }
            }
        }
        echo json_encode(['friendRequest' => $friendRequest]);
        exit;
    }

    public function getRequests() {
        $friendRequests = $this->FriendRequests->find()
            ->contain(
                'Users'
            )
            ->order(['FriendRequests.created' => 'DESC'])->all();
        echo json_encode(['friendRequests' => $friendRequests]);
        exit;
    }
    /**
     * Edit method
     *
     * @param string|null $id Friend Request id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $friendRequest = $this->FriendRequests->get($id, ['contain' => [],]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $friendRequest = $this->FriendRequests->patchEntity($friendRequest, $this->request->getData());
            if ($this->FriendRequests->save($friendRequest)) {
                $this->Flash->success(__('The friend request has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The friend request could not be saved. Please, try again.'));
        }
        $requestFroms = $this->FriendRequests->RequestFroms->find('list', ['limit' => 200]);
        $requestTos = $this->FriendRequests->RequestTos->find('list', ['limit' => 200]);
        $this->set(compact('friendRequest', 'requestFroms', 'requestTos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Friend Request id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $friendRequest = $this->FriendRequests->get($id);
        if ($this->FriendRequests->delete($friendRequest)) {
            $this->Flash->success(__('The friend request has been deleted.'));
        } else {
            $this->Flash->error(__('The friend request could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
