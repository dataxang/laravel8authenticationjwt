<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Notifications\Notifiable;


use Illuminate\Database\Eloquent\Model;

class Record extends Model
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
        'weight',
        'fat',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

}
