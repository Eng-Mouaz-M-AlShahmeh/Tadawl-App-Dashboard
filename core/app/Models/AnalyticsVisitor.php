<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalyticsVisitor extends Model
{
    use HasFactory;

    //Relation to AnalyticsPage
    public function vPages()
    {
        return $this->hasMany('App\Models\AnalyticsPage', "visitor_id");
    }
}
