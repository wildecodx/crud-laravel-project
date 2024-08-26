<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermodel extends Model
{
   protected $table = 'usermodels';  // from database this is the table name
   public $timestamp = false; // so that this will remove the created by and updated by in db
   // protected $fillable = ['username', 'password', 'email'];
}
