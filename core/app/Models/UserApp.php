<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserApp extends Model
{
    use HasFactory;

    protected $table='user';
    
    public function membership()
    {
        return $this->belongsTo('App\Models\Membership', 'id_mem');
    }
    
}
