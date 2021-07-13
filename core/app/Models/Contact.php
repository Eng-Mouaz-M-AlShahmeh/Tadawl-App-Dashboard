<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public function contactsGroup()
    {
        return $this->belongsTo('App\Models\ContactsGroup', 'group_id');
    }
}
