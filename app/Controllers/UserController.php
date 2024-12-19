<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AcessLevelModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        echo "User Controller";
    }

    public function __construct()
    {
        $db = \Config\Database::connect();
        $this->userModel = new UserModel();
    }

    public function checklogin(){
        if(session('logged_in')){
            return redirect()->to('/');
        }
        else{
            return redirect()->to('/login');
        }
    }

    public function login()
    {
        $data['pageName'] = 'login_page';
        $data['pageData'] = [];
        return view('template', $data);
    }

    public function postlogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $this->userModel->where('username', $username)->first();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->session->set('logged_in', true);
                $this->session->set('user_id', $user['id']);
                $this->session->set('username', $user['username']);
                return redirect()->to('/');
            } else {
                return redirect()->to('/login')->with('message', 'Invalid username or password');
            }
        } else {
            return redirect()->to('/login')->with('message', 'Invalid username or password');
        }
    }
    public function add_user()
    {
        $accessLevelModel = new AcessLevelModel();
        $levels = $accessLevelModel->find();

        $data['pageName'] = 'add_user';
        $data['pageData'] = $levels;
        return view('template', $data);

    }

    public function add_user_table()
    {
        $rules = [
            'email' => 'required|valid_email',
        ];

        $username = $this->request->getPost('username');
        $email = $this->request->getPost('email');
        $role = $this->request->getPost('role');
        $passowrd = $this->request->getPost('password');
        $date_of_birth = $this->request->getPost('date_of_birth');

        if ($username == "" || $email == "" || $role == "" || $passowrd == "" || $date_of_birth == "") {
            return redirect()->to('/add-user')->with('message', 'Please fill all fields');
        } else {
            $uniqueCheckUsername = $this->userModel->where('username', $username)->first();
            $uniqueCheckEmail = $this->userModel->where('email', $email)->first();
            if ($uniqueCheckUsername) {
                return redirect()->to('/add-user')->with('message', 'Username already exists');
            }
            if ($uniqueCheckEmail) {
                return redirect()->to('/add-user')->with('message', 'Email already exists');
            }
            if (strlen($username) < 6) {
                return redirect()->to('/add-user')->with('message', 'Username must be at least 6 characters.');
            }
            if (strlen($passowrd) < 8) {
                return redirect()->to('/add-user')->with('message', 'Password must be at least 8 characters.');
            }
            if (!$this->validate($rules)) {
                return redirect()->to('/add-user')->with('message', 'Not A valid email');

            } else {
                $accessLevelModel = new AcessLevelModel();
                $levels = $accessLevelModel->where('lid', $role)->first();
                $userModel = new UserModel();

                $user_data = [
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($passowrd, PASSWORD_DEFAULT),
                    'date_of_birth' => $date_of_birth,
                    'role' => $role
                ];
                $dbdata = $userModel->insert($user_data);
                return redirect()->to('/show-users');

            }
        }
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
        $data['pageName'] = 'show_users';
        $data['pageData'] = $resultTable->getResult();
        return view('template', $data);
    }

    public function updatedetails($id)
    {
        $userModel = new UserModel();
        $accessLevelModel = new AcessLevelModel();
        $levels = $accessLevelModel->find();
        $user = $userModel->where('id', $id)->first();

        $data['pageName'] = 'update_user';
        $data['pageData'] = ['user' => $user, 'levels' => $levels];
        return view('template', $data);

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

    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }
}
