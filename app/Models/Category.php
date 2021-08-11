<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use HasFactory;
    protected $fillable = [
        'id',
        'title',
        'description',
        'slug',
        'status',
        

    ];

    public function contents(){
        return $this->hasMany(Content::class);
    }
}
