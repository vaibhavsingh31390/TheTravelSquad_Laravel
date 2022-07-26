<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
  
    protected $fillable = ['path'];
    use HasFactory;
    
    public function mediaable(){
        return $this->morphTo();
    }

    public function url(){
        return Storage::url($this->path);
    }
}
