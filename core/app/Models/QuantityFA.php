<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantityFA extends Model
{
    use HasFactory;

    protected $table='quantityFeatureAqar';
    
        public function translateFA()
    {
        return $this->belongsTo('App\Models\QuantityFATranslation', 'id_QFAT');
    }
    
    
}
