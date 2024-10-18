<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReport extends Model
{

    protected $guarded = [];
    protected $table = 'service_reports';
    protected $fillable = [
        // Add all fields that are fillable
        'sr_number',
        'event_id',
        'date',
        'customer_name',
        'address',
        'contact_person',
        'contact_number',
        'start_time',
        'end_time',
        'total_hours',
        'remarks',
        'new_installation',
        'under_maintenance',
        'demo_poc',
        'billable',
        'under_warranty',
        'corrective_maintenance',
        'add_on',
        'others',
        'is_complete',
        'machine_model',
        'machine_serial_number',
        'product_number',
        'part_number',
        'part_quantity',
        'part_description',
        'part_usage',
        'action_taken',
        'pending',
        'engineer_assigned',
        'tech_support',
        'hr_finance',
        'evp_coo',
        'sr_image'
    ];


    public function maintenanceAgreements()
    {
        return $this->belongsToMany(MaintenanceAgreement::class, 'maintenance_agreement_service_report');
    }

    use HasFactory;
}
