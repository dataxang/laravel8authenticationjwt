<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class Exersise extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'date',
        'description',
        'action',
        'level',
        'energy',
        'duration',
        'created_by',
        'updated_by',
        'date',
        'created_at',
        'updated_at',
    ];

}
