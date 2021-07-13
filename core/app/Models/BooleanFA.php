<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooleanFA extends Model
{
    use HasFactory;

    protected $table='booleanFeatureAqar';
    
        public function translateFA()
    {
        return $this->belongsTo('App\Models\BooleanFATranslation', 'id_BFAT');
    }
    
    
}
