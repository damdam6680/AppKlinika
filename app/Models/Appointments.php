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
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }

    public function treatment()
    {
        return $this->belongsTo(Treatments::class, 'treatmets_id');
    }

}
