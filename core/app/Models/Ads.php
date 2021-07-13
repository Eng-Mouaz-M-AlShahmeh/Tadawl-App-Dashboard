<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $table='ads';
    //protected $fillable = ['title'];
    
    public function categoryAqar()
    {
        return $this->belongsTo('App\Models\CategoryAqar', 'id_category');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\UserApp', 'id_user');
    }
    
    public function description()
    {
        return $this->belongsTo('App\Models\Description', 'id_description');
    }
    
    
}
