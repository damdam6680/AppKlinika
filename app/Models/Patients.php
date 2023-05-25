<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Patients extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'pesel',
        'address',
        'phone',
        'email',
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
