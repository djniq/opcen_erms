<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function dispatch(): HasOne {
        return $this->hasOne(Dispatch::class);
    }

    // public function driver(): HasOne {
    //     return $this->hasOne(Driver::class);
    // }

    // public function ambulance(): HasOne {
    //     return $this->hasOne(Ambulance::class);
    // }

    public function healthFacility(): BelongsTo {
        return $this->belongsTo(HealthFacility::class);
    }

    public function fromHealthFacility(): HasOne {
        return $this->hasOne(HealthFacility::class, 'id', 'from_health_facility_id');
    }

    public function toHealthFacility(): HasOne {
        return $this->hasOne(HealthFacility::class, 'id', 'to_health_facility_id');
    }

    public function getStatus(int $status) {
        // 0: open; 1:dispatch initiated; 2: dispatch-completed; 3: closed without dispatch
        $statusVals = [
            0 => 'Pending',
            1 => 'Dispatch Initiated',
            2 => 'Dispatch Completed',
            3 => 'Closed Without Dispatch'
        ];

        return $statusVals[$status];
    }

    public function getCategory(string $category) {
        $catVals = [
            'step-up' => 'Step Up',
            'step-down' => 'Step Down'
        ];

        return $catVals[$category];
    }

    public function getVicinity(string $vicinity) {
        $vicinityVals = [
            'within' => 'Within La Union',
            'outside' => 'Outside La Union'
        ];

        return $vicinityVals[$vicinity];
    }
}
