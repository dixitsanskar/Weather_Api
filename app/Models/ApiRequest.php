<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiRequest extends Model
{
    //
    use HasFactory;
    
    protected $fillable=['user_id', 'request_count', 'month'];
}
