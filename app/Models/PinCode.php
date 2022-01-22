<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PinCode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'officename',
        'pincode',
        'officeType',
        'Deliverystatus',
        'divisionname',
        'regionname',
        'circlename',
        'Taluk',
        'Districtname',
        'statename',
    ];

}
