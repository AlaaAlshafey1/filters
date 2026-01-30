<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'job_title',
        'image',
        'order',
        'is_active',
    ];}
