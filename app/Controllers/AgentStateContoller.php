<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AgentStateContoller extends BaseController
{
    public function index()
    {
        $data['pageName'] = 'agentpanel';
        $data['pageData'] = [];
        return view('template', $data);
    }

    public function setstate()
    {
        $data = $this->request->getPost('body');
        // print_r($data);
        return $this->response->setJSON($data);
    }
}
