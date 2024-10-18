<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceAgreement extends Model
{
    protected $guarded = [];
    protected $table = 'maintenance_agreements';
    protected $fillable = [
        'serial_number',
        'account_manager',
        'account_manager_id',
        'start_date',
        'end_date',
        'distributor',
        'PO_number',
        'date_history',
        'company_name',
        'project_name',
        'supp_acc_ref',
        'service_agreement',
        'model_description',
        'product_number',
        'service_level',
        'location',
        'status',
    ];

    public function serviceReports()
    {
        return $this->belongsToMany(ServiceReport::class, 'maintenance_agreement_service_report');
    }


    use HasFactory;
}
