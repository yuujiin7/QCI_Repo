<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReport extends Model
{

    protected $guarded = [];

    protected $fillable = [
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
        'sr_image',
        



    ];

    use HasFactory;
}
