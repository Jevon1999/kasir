<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Verification extends Model
{
    use HashFactory;
    protected $guarded = [];
}
