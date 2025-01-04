<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class ChatController extends BaseController
{
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {
        $data['pageName'] = 'chats';
        $data['pageData'] = [];
        return view('template', $data);
    }

    public function getvalue()
    {
        $data = [
            'username' => session('data')['username'],
            'recievername' => session('body')->username,
        ];
        return $this->response->setJSON($data);
    }

    public function getUers()
    {
        $users = $this->userModel->where('username != ', session('data')['username'])->findAll();
        return $this->response->setJSON($users);
    }

    public function userSession()
    {
        $body = $this->request->getJSON();
        session()->set('body', $body);
        return $this->response->setJSON($body);
    }
}
