<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'transaction_type',
    ];
    public $timestamps = false;
}
