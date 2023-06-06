<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'dentist_id',
        'treatmets_id',
        'visit_date',
        'visit_time',
        'description',
        'visit_end'
    ];
    public function treatments()
    {
        return $this->belongsTo(Treatments::class);
    }
}
