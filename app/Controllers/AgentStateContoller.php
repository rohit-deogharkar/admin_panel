<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\LoggerReportController;

class AgentStateContoller extends BaseController
{
    public function __construct()
    {
        $this->loggerController = new LoggerReportController();
    }
    public function index()
    {
        $data['pageName'] = 'agentpanel';
        $data['pageData'] = [];
        return view('template', $data);
    }

    public function setstate()
    {
        $data = $this->request->getJSON();
        $url = 'http://localhost:5000/redis/setstate';
        $this->loggerController->postCurlRequest($url, $data);
        return $this->response->setJSON($data);
    }

    // public function checkReadyToReady(){
        
    // }
}
