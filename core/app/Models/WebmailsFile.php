<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebmailsFile extends Model
{
    use HasFactory;

    public function webmails()
    {
        return $this->hasMany('App\Models\Webmail', 'group_id');
    }
}
