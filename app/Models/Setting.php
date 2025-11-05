<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'tbl_settings';
    protected $fillable = [
        'site_name',
        'contact_email',
        'phone',
        'address'
    ];

    public $timestamps = true;
}
