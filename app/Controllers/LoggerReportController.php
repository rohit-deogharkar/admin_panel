<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class LoggerReportController extends BaseController
{
    public function index()
    {
        $data['pageName'] = 'loggerReport';
        $data['pageData'] = $this->getMysql();
        return view('template', $data);
        // print_r($data['pageData']);
    }

    public function getMysql()
    {
        $ch = curl_init();
        $url = 'http://localhost:3000/mysql/get';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = json_decode(curl_exec($ch), true);
        return $response;
    }

    public function getMysqlHourly()
    {
        $data = [];
        $condition = $this->request->getGet('reportType');
        if ($condition) {
            $ch = curl_init();
            $url = 'http://localhost:3000/mysql/get/summarize/' . $condition;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($ch), true);
        } else {
            $ch = curl_init();
            $url = "http://localhost:3000/mysql/get/summarize/hourly";
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = json_decode(curl_exec($ch), true);
        }

        $data['pageName'] = 'hourlyReport';
        $data['pageData'] = $response;
        return view('template', $data);
        // print_r($data);

    }

    public function download()
    {
        $data = $this->getMysql();
        $fileName = 'logger_report' . date('Ymd') . '.csv';

        header('Content-Description: File Transfer');
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename={$fileName}");

        $file = fopen('php://output', 'w');

        $headers = [
            'callstart',
            'call_type',
            'dispose_name',
            'dispose_type',
            'duration',
            'agentname',
            'campaign_name',
            'process_name',
            'leadset_id',
            'reference_uuid',
            'customer_uuid',
            'hold',
            'mute',
            'ringing',
            'transfer_time',
            'conference',
            'call_time',
            'dispose_time'
        ];

        fputcsv($file, $headers);

        $arr = [];
        for ($i = 0; $i < count($data); $i++) {
            $arr[$i] = [
                'callstart' => $data[$i]['callstart'],
                'call_type' => $data[$i]['call_type'],
                'dispose_name' => $data[$i]['dispose_name'],
                'dispose_type' => $data[$i]['dispose_type'],
                'duration' => $data[$i]['duration'],
                'agentname' => $data[$i]['agentname'],
                'campaign_name' => $data[$i]['campaign_name'],
                'process_name' => $data[$i]['process_name'],
                'leadset_id' => $data[$i]['leadset_id'],
                'reference_uuid' => $data[$i]['reference_uuid'],
                'customer_uuid' => $data[$i]['customer_uuid'],
                'hold' => $data[$i]['hold'],
                'mute' => $data[$i]['mute'],
                'ringing' => $data[$i]['ringing'],
                'transfer_time' => $data[$i]['transfer_time'],
                'conference' => $data[$i]['conference'],
                'call_time' => $data[$i]['call_time'],
                'dispose_time' => $data[$i]['dispose_time']
            ];
        }

        foreach ($arr as $ar) {
            fputcsv($file, $ar);
        }

        fclose($file);
    }


}
