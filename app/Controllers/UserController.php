<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;


class UserController extends BaseController
{

    public function __construct()
    {

    }
    public function add_user()
    {
        return view('navbar')
            . view('add_user');

    }

    public function add_user_table()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        
        $userModel = new UserModel();
        // if ($userModel->where('username', $username)) {
        //     return redirect()->to('/add-user')->with('error', 'username already exist!');
        // } else if ($userModel->find()->where(['username' => $email])) {
        //     return redirect()->to('/add-user')->with('error', 'email already exist!');
        // } else {
            $user_data = [
                'username' => $username,
                'email' => $email,
                'password' => $this->request->getPost('password'),
                'date_of_birth' => $this->request->getPost('date_of_birth'),
                'role' => $this->request->getPost('role')
            ];
           $dbdata =  $userModel->insert($user_data);
            return redirect()->to('/');
        // }

    }

    public function showusers(){
        $userModel = new UserModel();
        $users = $userModel->findAll();
        return view('navbar')
        .view('show_users', ['users' => $users]);
    }

    public function updatedetails($id){
        $userModel = new UserModel();
        $user = $userModel->where('id', $id)->first();
        return view('navbar')
        .view('update_user', ['user' => $user]);
    }
    public function postupdatedetails($id){
        $userModel = new UserModel();
        $userModel->update($id, [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'role' => $this->request->getPost('role')
        ]);
        return redirect()->to('/');
    }

    public function delete($id){
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/');
    }
}
