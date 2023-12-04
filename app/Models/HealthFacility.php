<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFacility extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'hf_name',
        'hf_location',
        'hf_email',
        'hf_contact_no',
        'hf_level',
        'status',
        'updated_by',
        'created_by'
    ];
}
