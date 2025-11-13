<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- Ditambahkan

class Role extends Model
{
    use HasFactory; // <-- Ditambahkan
    
    protected $table = 'roles';
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}