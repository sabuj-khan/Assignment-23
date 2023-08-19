<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['firstName', 'lastName', 'email', 'phone', 'password', 'otp'];
    protected $attributes = ['otp'=>'0'];

    public function income(){
        return $this->hasMany(Income::class);
    }

    public function expense(){
        return $this->hasMany(Expense::class);
    }

   
}
