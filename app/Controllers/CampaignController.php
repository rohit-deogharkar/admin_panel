<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CampaignModel;

class CampaignController extends BaseController
{
    public function __construct()
    {
        // $campaignModel = new CampaignModel();
        $this->userModel = new \App\Models\UserModel();
        $this->campaignModel = new CampaignModel();
        $this->db = \Config\Database::connect();
    }
    public function index()
    {
        $query = 'select *, ( select username from user where user.id = campaign.supervisor_id ) as supervisor from campaign;';
        $resultTable = $this->db->query($query);

        $data['pageName'] = 'show_campaign';
        $data['pageData'] = $resultTable->getResult();
        return view('template', $data);
    }

    public function add()
    {
        $supservisors = $this->userModel->where('role', 2)->find();
        $data['pageName'] = 'create_campaign';
        $data['pageData'] = ['supservisors' => $supservisors];
        return view('template', $data);
    }

    public function insertCampaign()
    {
        $data = [
            'campaign_name' => $this->request->getPost('campaign_name'),
            'campaign_description' => $this->request->getPost('campaign_description'),
            'supervisor_id' => $this->request->getPost('supervisor_id')
        ];
        if($data['campaign_name'] == "" || $data['campaign_description'] == "" || $data['supervisor_id'] == ""){
            return redirect()->to('/add-campaign')->with('message', 'Please fill all fields');
        }

        $message = $this->campaignModel->addCampaign($data);

        if ($message['status'] == 'success') {
            return redirect()->to('/show-campaigns')->with('message', $message['message']);
        }
        if ($message['status'] == 'failed') {
            return redirect()->to('/add-campaign')->back()->withInput()->with('message', $message['message']);
        }

    }

    public function edit($id)
    {
        $supservisors = $this->userModel->where('role', 2)->find();
        $updatedetails = $this->campaignModel->getCampaignUpdateDetails($id);

        $data['pageName'] = 'update_campaign';
        $data['pageData'] = ['updatdetails' => $updatedetails, 'supservisors' => $supservisors];
        return view('template', $data);
    }

    public function postedit($id)
    {
        $data = [
            'campaign_name' => $this->request->getPost('campaign_name'),
            'campaign_description' => $this->request->getPost('campaign_description'),
            'supervisor_id' => $this->request->getPost('supervisor_id')
        ];

        $this->campaignModel->postCampaignUpdateDetails($id, $data);
        return redirect()->to('/show-campaigns');
    }

    public function delete($id)
    {
        $this->campaignModel->deleteCampaign($id);
        return redirect()->to('/show-campaigns');
    }
}
