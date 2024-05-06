<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceReport extends Model
{
    use HasFactory;

    /**
     * Get the images associated with the service report.
     */
    public function srImages()
    {
        return $this->hasMany(SrImage::class);
    }
}
