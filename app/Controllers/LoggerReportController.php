<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LoggerReportController extends BaseController
{

    public function curlRequest($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch), true);
        return $response;
    }

    public function postCurlRequest($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        return $response;
    }

    public function dataForFilters($condition = null)
    {

        $agentname_array = [];
        $campaign_name_array = [];
        $process_name_array = [];
        $dispose_type_array = [];
        $dispose_name_array = [];
        $leadset_id_array = [];
        $call_type_array = [];

        foreach ($this->getMysql() as $myData) {
            array_push($agentname_array, $myData['agentname']);
            array_push($campaign_name_array, $myData['campaign_name']);
            array_push($process_name_array, $myData['process_name']);
            array_push($dispose_type_array, $myData['dispose_type']);
            array_push($dispose_name_array, $myData['dispose_name']);
            array_push($leadset_id_array, $myData['leadset_id']);
            array_push($call_type_array, $myData['call_type']);
        }

        $data = [
            'agentname' => array_unique($agentname_array),
            'campaign_name' => array_unique($campaign_name_array),
            'process_name' => array_unique($process_name_array),
            'dispose_type' => array_unique($dispose_type_array),
            'dispose_name' => array_unique($dispose_name_array),
            'leadset_id' => array_unique($leadset_id_array),
            'call_type' => array_unique($call_type_array),
            'condition' => $condition
        ];

        return $data;
    }
    public function index()
    {
        $datarequest = $this->request->getGet('datarequest');

        if ($datarequest) {
            if ($datarequest == 'sql') {
                $data['pageData'] = $this->getMysql();
            } else if ($datarequest == 'mongo') {
                $data['pageData'] = $this->getMongo();
            } else if ($datarequest == 'elastic') {
                $data['pageData'] = $this->getElastic();
            }
        } else {
            $data['pageData'] = $this->getMysql();
        }

        $data['pageName'] = 'loggerReport';
        $data['filterdata'] = $this->dataForFilters();
        return view('template', $data);
    }

    public function getMysql()
    {
        $url = 'http://localhost:3000/mysql/get';
        $response = $this->curlRequest($url);
        return $response;
    }
    public function getElastic()
    {
        $url = 'http://localhost:3000/elasticsearch/get';
        $response = $this->curlRequest($url);
        return $response;
    }
    public function getMongo()
    {
        $url = 'http://localhost:3000/mongo/get';
        $response = $this->curlRequest($url);
        return $response;
    }

    public function getMysqlSummarize()
    {
        $condition = $this->request->getGet('reportType');
        if ($condition) {
            $url = 'http://localhost:3000/mysql/get/summarize/' . $condition;
            $response = $this->curlRequest($url);
        } else {
            $url = "http://localhost:3000/mysql/get/summarize/hourly";
            $response = $this->curlRequest($url);
        }

        $data['pageName'] = 'hourlyReport';
        $data['pageData'] = $response;

        print_r($data);
        // return view('template', $data);
    }

    public function getElasticSummarize()
    {
        $url = 'http://localhost:3000/elasticsearch/get/summarize';
        $response = $this->curlRequest($url);
        print_r($response);
    }

    public function getMongoSummarize()
    {
        $url = 'http://localhost:3000/mongodb/get/summarize';
        $response = $this->curlRequest($url);
        print_r($response);
    }

    public function downloadMysqlCdr()
    {
        $data = $this->getMysql();
        $this->download($data);
    }

    public function downloadMongodbCdr()
    {
        $data = $this->getMongo();
        $this->download($data);
    }

    public function downloadElasticCdr()
    {
        $data = $this->getElastic();
        $this->download($data);
    }

    public function filter()
    {
        $url = 'http://localhost:3000/mysql/get/filter';

        $campaign_name = $this->request->getPost('campaign_name');
        $agentname = $this->request->getPost('agentname');
        $process_name = $this->request->getPost('process_name');
        $call_type = $this->request->getPost('call_type');
        $dispose_name = $this->request->getPost('dispose_name');
        $dispose_type = $this->request->getPost('dispose_type');
        $leadset_id = $this->request->getPost('leadset_id');

        $condition_array = [];

        !empty($campaign_name) ? $condition_array['campaign_name'] = $campaign_name : null;
        !empty($agentname) ? $condition_array['agentname'] = $agentname : null;
        !empty($process_name) ? $condition_array['process_name'] = $process_name : null;
        !empty($call_type) ? $condition_array['call_type'] = $call_type : null;
        !empty($dispose_name) ? $condition_array['dispose_name'] = $dispose_name : null;
        !empty($dispose_type) ? $condition_array['dispose_type'] = $dispose_type : null;
        !empty($leadset_id) ? $condition_array['leadset_id'] = $leadset_id : null;

        $response = $this->postCurlRequest($url, $condition_array);

        $data['pageData'] = json_decode($response, true);
        $data['pageName'] = 'loggerReport';
        $data['filterdata'] = $this->dataForFilters($condition_array);

        return view('template', $data);
    }

    public function download($data)
    {
        $fileName = 'logger_report' . date('Ymd') . '.csv';

        header('Content-Description: File Transfer');
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename={$fileName}");

        $file = fopen('php://output', 'w');

        for ($i = 0; $i < 1; $i++) {
            $headers = array_keys($data[$i]);
        }

        fputcsv($file, $headers);

        foreach ($data as $ar) {
            fputcsv($file, $ar);
        }

        fclose($file);
    }
}
