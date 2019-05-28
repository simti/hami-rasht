<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
  protected $table = 'periods';
  // protected $dateFormat = 'Asia/Tehran';
  protected $guarded = [];


  /**
   * The Donor that the transaction belongs to.
  */
  public function transactions()
  {
    return $this->hasMany('App\Transaction');
  }

}
