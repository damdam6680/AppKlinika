<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'pesel',
        'address',
        'phone',
        'email',
        'gender',
        'birtday'
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
