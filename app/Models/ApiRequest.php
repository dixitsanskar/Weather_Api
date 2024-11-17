<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ApiRequest extends Model
{
    //
    use HasFactory;
    protected $connection = 'mongodb';

    
    protected $fillable=['user_id', 'request_count', 'month'];
}
