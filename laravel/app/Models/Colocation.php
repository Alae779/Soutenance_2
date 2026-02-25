<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = ['name', 'status', 'owner_id'];
    protected $guarded = ['id'];
    public $timestamps = false;

    public function isOwner(User $user){
        return $this->owner_id === $user->id;
    }
    public function members(){
        return $this->belongsToMany(User::class, 'memberships')->withPivot('role', 'left_at');
    }
    public function activeMembers(){
        return $this->belongsToMany(User::class, 'memberships')->withPivot('role', 'left_at')->wherePivotNull('left_at');
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
