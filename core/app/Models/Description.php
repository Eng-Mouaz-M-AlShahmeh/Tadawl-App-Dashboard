<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    protected $table='adsDescription';
    
    public function typeRes()
    {
        return $this->belongsTo('App\Models\TypeRes', 'id_typeRes');
    }
    
    public function typeAqar()
    {
        return $this->belongsTo('App\Models\TypeAqar', 'id_type_aqar');
    }
    
    public function interfaceAqar()
    {
        return $this->belongsTo('App\Models\InterfaceAqar', 'id_interface');
    }
    
}
