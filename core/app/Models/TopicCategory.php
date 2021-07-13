<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicCategory extends Model
{
    use HasFactory;

    //Relation to Sections
    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
}
