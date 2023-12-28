<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_meta extends Model
{
    use HasFactory;
    protected $table = 'user_meta';
    protected  $fillable = [
        'user_id',
        'dob',
        'street_address',
        'city',
        'zip_code',
        'state',
        'country',
        'contact_no',
    ];
}
