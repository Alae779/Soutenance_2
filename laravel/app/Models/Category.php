<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'colocation_id'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function colocations(){
        return $this->belongsTo(Colocation::class);
    }
    public function exponses(){
        return $this->hasMany(Exponse::class);
    }
}
