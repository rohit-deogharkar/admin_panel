<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AcessLevelModel;
use App\Models\UserModel;

class UserController extends BaseController
{

    public function __construct()
    {
        $db = \Config\Database::connect();
    }
    public function add_user()
    {

        $accessLevelModel = new AcessLevelModel();
        $levels = $accessLevelModel->find();

        return view('add_user', ['levels' => $levels]);

    }

    public function add_user_table()
    {
        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');

        $accessLevelModel = new AcessLevelModel();
        $levels = $accessLevelModel->where('lid', $role)->first();
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
        $dbdata = $userModel->insert($user_data);
        // }
        return redirect()->to('/show-users');
    }

    public function showusers()
    {
        $db = \Config\Database::connect();
        $userModel = new UserModel();
        $accessLevelModel = new AcessLevelModel();

        $levels = $accessLevelModel->findAll();
        $users = $userModel->findAll();

        $query = 'select *, ( select level_name from access_level where access_level.lid = user.role ) as accessname from user;';
        $resultTable = $db->query($query);
        // print_r($resultTable->getResult());

        return view('show_users', ['users' => $resultTable->getResult()]);
    }

    public function updatedetails($id)
    {
        $userModel = new UserModel();
        $accessLevelModel = new AcessLevelModel();
        $levels = $accessLevelModel->find();
        $user = $userModel->where('id', $id)->first();

        return view('update_user', ['user' => $user, 'levels' => $levels]);
    }
    public function postupdatedetails($id)
    {
        $userModel = new UserModel();
        $userModel->update($id, [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'date_of_birth' => $this->request->getPost('date_of_birth'),
            'role' => $this->request->getPost('role')
        ]);
        return redirect()->to('/show-users');
    }

    public function delete($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/show-users');
    }
}
