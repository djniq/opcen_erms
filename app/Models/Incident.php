<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'health_facility_id',
        'reported_datetime',
        'nature_of_operation',
        'transfer_category',
        'transfer_vicinity',
        'from_health_facility_id',
        'to_health_facility_id',
        'origin',
        'destination',
        'status',
        'deleted',
        'patient_ehr_id',
        'patient_first_name',
        'patient_last_name',
        'patient_middle_name',
        'patient_birthdate',
        'patient_address',
        'chief_complaint',
        'remarks',
        'updated_by',
        'created_by'
    ];
}
