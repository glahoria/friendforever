<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {

    public function initialize() {
        parent::initialize();
        $this->Auth->allow(['contact', 'add', 'forgotPassword', 'resetPassword']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index() {
        $key = $this->request->getQuery('key');

        if (!empty($key)) {
            $this->paginate = ['conditions' => ['OR' => ['first_name LIKE' => '%' . $key . '%', 'last_name LIKE' => '%' . $key . '%', 'email LIKE' => '%' . $key . '%', 'phone LIKE' => '%' . $key . '%']]];
        }
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    public function login() {

        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }


        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Your username or password was incorrect.'));
        }
    }
    public function forgotPassword() {
        if ($this->request->is('post')) {
            $email = $this->request->getData('email');
            $user = $this->Users->find('all')->where(['email'=>$email])->first();
            if(empty($user)){
                $this->Flash->error(__('Please enter valid email.'));
                return $this->redirect(['action'=>'forgotPassword']);
            } else {
                $token = uniqid();
                $user->forgot_password_token = $token;

                if($this->Users->save($user)){

                    $options = [
                        'template' => 'forgot_password',
                        'to' => 'thindgurjeet366@gmail.com',
                        'subject' => _('Forgot Password to ' . SITE_TITLE),
                        'viewVars' => [
                            'name' => $user->first_name,
                            'url' => SITE_URL.'users/reset-Password/'.$token
                        ]
                    ];
                    // pr($options); die;
                    $this->loadComponent('EmailManager');
                    $this->EmailManager->sendEmail($options);
                    //send Email
                    $this->Flash->success(__('Send a forgot password link  on your email.'));
                }

            }

        }
        $this->set(compact('user'));
    }
    public function resetPassword($token = null) {
		if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->findByForgotPasswordToken($this->request->data['forgot_password_token'])->first();
				if ($user) {
					/*
					 * Restrict user to edit only while listed fields
					 */
					$editableFields = ['password', 'verify_password', 'forgot_password_token'];
					foreach ($this->request->getData() as $field => $val) {
						if (!in_array($field, $editableFields)) {
							unset($this->request->getData()[$field]);
						}
					}
					$user['forgot_password_token'] = "";
					$user = $this->Users->patchEntity($user, $this->request->getData());
					if ($this->Users->save($user)) {
						$this->Flash->success(__('Your password has been updated.'));
						return $this->redirect(['action'=>'login']);
					} else {
						$this->Flash->error(__('Something went wrong. Please, try again.'));
						
						return $this->redirect(['action'=>'resetPassword', $this->request->data['forgot_password_token']]);
					}
				}
            } 
				if ($token != null) {
					$user = $this->Users->find('all')->where(['forgot_password_token'=>$token])->first();
					if(empty($user)){
						$this->Flash->error(__('Invalid Token.'));
						return $this->redirect(['action'=>'login']);
					} else {

						$this->set('token', $token);
					}

				} else {
					$this->Flash->error(__('Invalid Token.'));
					return $this->redirect(['action'=>'login']);
				}
				$this->set(compact('user'));

        
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function dashboard() {
    }
    public function wall() {
    }
    public function profile() {
        $user = $this->Users->get($this->Auth->user('id'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('Your profile has been updated.'));

                return $this->redirect(['action' => 'profile']);
            }
            $this->Flash->error(__('Your profile could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function changePassword() {
        $id = $this->request->session()->read('Auth.User.id');
        $user = $this->Users->get($id, []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //pr($this->request->getData());die;
            //$object = new DefaultPasswordHasher;
            //$changePassword = $object->check($this->request->data['current_password'], $password);
            //if($this->Auth->user('password') == $changePassword)
            //{
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Your Password has been update succefully'));
                return $this->redirect(['action' => 'profile']);
            } else {
                $this->Flash->error(__('Password could not be changes, Plaes try again.'));
            }
            //}

        }

        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }


    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $user = $this->Users->get($id, ['contain' => []]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
        if ($this->Auth->user()) {
            return $this->redirect($this->Auth->redirectUrl());
        }
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    public function contact() {

    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, ['contain' => []]);
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
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
