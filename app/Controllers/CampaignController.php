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
    }
    public function index()
    {
        $db = \Config\Database::connect();
        $campaignModel = new CampaignModel();
        $campaigns = $campaignModel->showCampaigns();

        $query = 'select *, ( select username from user where user.id = campaign.supervisor_id ) as supervisor from campaign;';
        $resultTable = $db->query($query);
        return view('show_campaign', ['campaigns' => $resultTable->getResult()]);
    }

    public function add()
    {
        $supservisors = $this->userModel->where('role', 2)->find();
        return view('create_campaign', ['supservisors' => $supservisors]);
    }

    public function insertCampaign()
    {
        $data = [
            'campaign_name' => $this->request->getPost('campaign_name'),
            'campaign_description' => $this->request->getPost('campaign_description'),
            'supervisor_id' => $this->request->getPost('supervisor_id')
        ];
        $this->campaignModel->addCampaign($data);
        return redirect()->to('/show-campaigns');
    }

    public function edit($id)
    {
        $supservisors = $this->userModel->where('role', 2)->find();
        $updatedetails = $this->campaignModel->getCampaignUpdateDetails($id);
        return view('update_campaign', ['updatdetails' => $updatedetails, 'supservisors' => $supservisors]);
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
