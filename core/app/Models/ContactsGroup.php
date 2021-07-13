<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactsGroup extends Model
{
    use HasFactory;

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'group_id');
    }
}
