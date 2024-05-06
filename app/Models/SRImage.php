<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRImage extends Model
{
    use HasFactory;
     /**
     * Get the service report that owns the image.
     */
    public function serviceReport()
    {
        return $this->belongsTo(ServiceReport::class);
    }
    // protected $fillable = ['name', 'image_data'];
}