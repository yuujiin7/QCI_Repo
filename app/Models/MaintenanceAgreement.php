<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceAgreement extends Model
{
    protected $guarded = [];
    protected $table = 'maintenance_agreements';
    protected $fillable = [
        'serial_number', 'account_manager', 'account_manager_id', 'date_history', 
        'start_date', 'end_date', 'distributior', 'PO_number', 'company_name', 
        'project_name', 'supp_acc_ref', 'service_agreement', 'model_description', 
        'product_number', 'service_level', 'location'
    ];





    use HasFactory;
}
