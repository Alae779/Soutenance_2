<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exponse extends Model
{
    protected $fillable = ['title', 'amount', 'category_id', 'payer_id', 'date'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function categories(){
        return $this->belongsTo(Category::class);
    }
    public function payer(){
        return $this->belongsTo(User::class, 'payer_id');
    }
}
