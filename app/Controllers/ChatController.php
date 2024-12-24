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
}
