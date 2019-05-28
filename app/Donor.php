<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Donee;

class Donor extends Model
{
  use SoftDeletes;
  
  protected $table = 'donors';
  // protected $dateFormat = 'Asia/Tehran';
  protected $guarded = [];

  // numbers of donees

  //lendth of cooperation

  /**
   * status codes
   */
  const ACTIVE = 1;
  const DEACTIVE = 2;
  const DELETED = 3;

  /**
   * gender codes
   */
  const MALE = 1;
  const FEMALE = 2;

  /**
   * maritial status codes
   */
  const SINGLE = 1;
  const MARRIED = 2;
  const DIVORCED = 3;


  // Relationships
  /**
   * The donees that belong to the donor.
   */
  public function donees()
  {
    return $this->belongsToMany(Donee::class, 'donee_donor')->withPivot('donation_type', 'money_amount','non_money_detail');
  }

  /**
   * The transactions that belong to the donor.
   */
  public function transactions()
  {
    return $this->hasMany('App\Transaction');
  }
}
