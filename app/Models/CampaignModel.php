<?php

namespace App\Models;

use CodeIgniter\Model;

class CampaignModel extends Model
{
    protected $table = 'campaign';
    protected $primaryKey = 'cid';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['cid', 'campaign_name', 'campaign_description', 'supervisor_id'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function showCampaigns()
    {
        return $this->find();
    }

    public function addCampaign($data)
    {
        $this->insert($data);
    }

    public function getCampaignUpdateDetails($id)
    {
        return $this->where('cid', $id)->first();
    }

    public function postCampaignUpdateDetails($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteCampaign($id)
    {
        return $this->delete($id);
    }
}
