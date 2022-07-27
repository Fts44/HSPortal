<?php

namespace App\Models\index;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login_model extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'accounts';
}
