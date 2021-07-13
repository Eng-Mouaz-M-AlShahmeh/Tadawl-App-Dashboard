<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebmasterSection extends Model
{
    use HasFactory;

    public function sections()
    {
        return $this->hasMany('App\Models\Section', 'webmaster_id')->orderby('row_no', 'asc');
    }

    public function topics()
    {
        return $this->hasMany('App\Models\Topic', 'webmaster_id')->orderby('row_no', 'asc');
    }

    public function menus()
    {
        return $this->hasMany('App\Models\Menu', 'cat_id')->orderby('row_no', 'asc');
    }

    public function customFields()
    {
        return $this->hasMany('App\Models\WebmasterSectionField', 'webmaster_id')->where('status', '!=', 0)->orderby('row_no', 'asc');
    }

    public function allCustomFields()
    {
        return $this->hasMany('App\Models\WebmasterSectionField', 'webmaster_id')->orderby('row_no', 'asc');
    }
}
