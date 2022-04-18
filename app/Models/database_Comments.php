<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class database_Comments extends Model
{
    use HasFactory;

    public function posts(){
        return $this->belongsTo('App\Models\database_Posts');
    }
}
