<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $fillable = [
        'dentist_id',
        'treatmets_id',
        'visit_date',
        'visit_time',
        'description',
    ];
    public function treatments()
    {
        return $this->belongsTo(Treatments::class);
    }
}
