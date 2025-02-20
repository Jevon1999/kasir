<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory; // Perbaikan dari HashFactory

    protected $guarded = []; // Memungkinkan mass assignment
}
