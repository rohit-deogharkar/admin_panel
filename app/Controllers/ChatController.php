<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ChatController extends BaseController
{
    public function index()
    {
        $data['pageName'] = 'chats';
        $data['pageData'] = [];
        return view('template', $data);
    }

    public function getvalue(){
        session()->set('username', 'anupam');
        $username = ['username'=>session('username')];
        return $this->response->setJSON($username);
    }
}
