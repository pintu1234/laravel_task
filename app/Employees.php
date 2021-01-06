<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
   protected $guarded = ['id'];
   protected $fillable = ['first_name', 'last_name', 'company', 'email', 'phone'];
   protected $dates = ['created_at', 'updated_at'];
}
