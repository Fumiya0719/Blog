<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cat_gen extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'cat_gen';
}
