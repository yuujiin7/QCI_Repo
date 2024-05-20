<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tsg extends Model
{

    protected $guarded = [];
    
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'email',
        'phone_number',
        'age',
        'gender',
        'emp_id'
    ];
    
    use HasFactory;
}
