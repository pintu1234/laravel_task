<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
   protected $guarded = ['id'];
   protected $fillable = ['name', 'email', 'logo'];
   protected $dates = ['created_at', 'updated_at'];
}
