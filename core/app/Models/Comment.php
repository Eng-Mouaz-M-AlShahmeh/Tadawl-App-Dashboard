<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //Relation to Topics
    public function topics()
    {
        return $this->belongsTo('App\Models\Topic', 'topic_id');
    }

}
