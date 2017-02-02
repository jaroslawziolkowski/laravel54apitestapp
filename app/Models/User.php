<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    public $timestamps = true;
    protected $fillable = ['email', 'first_name','last_name','gender'
    ,'country', 'bonus', 'deposit_period','balance', 'bonus_balance',
  'created_at', 'updated_at'];

}
