<?php

namespace App\Models;

use App\Traits\KeyGenerate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, KeyGenerate;

    protected $fillable = ['name', 'slug'];

    protected $hidden = ['updated_at'];
}
