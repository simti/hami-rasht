<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

  protected $table = 'transactions';
  // protected $dateFormat = 'Asia/Tehran';
  protected $guarded = [];

  /**
   * payment type codes
  */
  const CASH = 1;
  const NOCASH = 2;
  const SERVICE = 3;

  /**
   * The Donor that the transaction belongs to.
  */
  public function Donor()
  {
    return $this->belongsTo('App\Donor');
  }

  /**
   * The Donee that the transaction belongs to.
  */
  public function Donee()
  {
    return $this->belongsTo('App\Donee');
  }

  
  /**
   * The period that the transaction belongs to.
  */
  public function period()
  {
    return $this->belongsTo('App\Period');
  }

}
