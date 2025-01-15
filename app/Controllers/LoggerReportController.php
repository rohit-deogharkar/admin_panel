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

    public function index()
    {
        $data['pageName'] = 'loggerReport';
        $data['pageData'] = $this->getMysql();
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
        $url = 'http://localhost:3000/elastic/get';
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
        return view('template', $data);
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
