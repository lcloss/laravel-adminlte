<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function getStatusAttribute($value)
    {
        return __(config('constants.status.' . $value));
    }
}
