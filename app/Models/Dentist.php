<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Dentist extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'specialization',
        'phone_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
