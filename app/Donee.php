<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Donor;

class Donee extends Model
{
  use SoftDeletes;
  
  protected $table = 'donees';
  // protected $dateFormat = 'Asia/Tehran';
  protected $guarded = [];


  // supporter's name

  //supporters' mobile

  /**
   * status codes
   */
  const ACTIVE = 1;
  const DEACTIVE = 2;
  
  /**
   * disabled status codes
   */
  const DISABLED = 1;
  const NOT_DESABLED = 2;

  /**
   * output type
   */
  const BANK = 1;
  const NOT_BANK = 2;

  
  //Relashionships

  /**
   * The users that belong to the role.
  */
  public function donors()
  {
      return $this->belongsToMany(Donor::class, 'donee_donor')->withPivot('donation_type', 'money_amount','non_money_detail');
  }

  /**
   * The transactions that belong to the donee.
   */
  public function transactions()
  {
    return $this->hasMany('App\Transaction');
  }

  public function scopeActive($query)
  {
      return $query->where('status', 1);
  }

  public function scopeDeactive($query)
  {
      return $query->where('status', 2);
  }
}
