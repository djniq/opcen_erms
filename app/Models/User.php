<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'firstname',
        'lastname',
        'middlename',
        'contact_no',
        'status',
        'role'
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function healthFacility(): BelongsTo {
        return $this->belongsTo(HealthFacility::class);
    }

    public function getStatus(int $status) {
        $statusVals = [
            1 => 'Active',
            2 => 'Inactive'
        ];

        return $statusVals[$status];
    }

    public function getRole(string $role) {
        $roleVals = [
            'superadmin' => 'Super Admin',
            'hfadmin' => 'Health Facility Administrator',
            'opcen' => 'Primary OpCen User',
            'emt' => 'EMT staff/responder'
        ];

        return $roleVals[$role];
    }
}
