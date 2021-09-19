<?php

namespace App\Models;

use App\Models\Traits\Statusable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory, Statusable;

    protected $fillable = ['name', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
