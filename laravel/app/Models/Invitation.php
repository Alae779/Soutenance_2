<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = ['email', 'token', 'colocation_id', 'status', 'expires_at'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
