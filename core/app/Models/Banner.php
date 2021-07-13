<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    public function webmasterBanner()
    {
        return $this->belongsTo('App\Models\WebmasterBanner', 'section_id');
    }
}
