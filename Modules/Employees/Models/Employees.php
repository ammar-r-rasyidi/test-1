<?php
/*!
* Copyright 2020
* Authors : ammar rizal rasyidi
* Authors Email : (ammar.r.rasyidi@gmail.com)
* Licensed under Personal Use License

* The content owner grants the buyer a non-exclusive, perpetual, personal use
* license to view, download, display, and copy the content, subject to the
* following restrictions:

* The content is licensed for personal use only, not commercial use. The
* content may not be used in any way whatsoever in which you charge money,
* collect fees, or receive any form of remuneration. The content may not be
* resold, relicensed, sub-licensed, rented, leased, or used in advertising.

* Title and ownership, and all rights now and in the future, of and for the
* content remain exclusively with the content owner.

* There are no warranties, express or implied. The content is provided 'as
* is.'

* Neither the content owner, payment processing service, nor hosting service
* will be liable for any third party claims or incidental, consequential, or
* other damages arising out of this license or the buyer's use of the content. */

namespace Modules\Employees\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Employees extends Model {
  
  // use SoftDeletes;
  
  protected $table = "employees";

  public $guarded = [];

  protected $hidden = [
    'deleted_at'
  ];

  protected $appends=[
    'full_name',
  ];

  public function getFullNameAttribute($value) {

    return $this->first_name." ".$this->last_name;
  }

  public function company() {
    return $this->hasOne('Modules\Companies\Models\Companies', 'id', 'company_id')
    ->withDefault([
        'name' => 'N/A'
    ]);
  }

  public function getCreatedAtAttribute($value){
    return Carbon::parse($value)->format('d F Y H:i:s');
  }

  public function getUpdatedAtAttribute($value){
    return Carbon::parse($value)->format('d F Y H:i:s');
  }

  public function getDeletedAtAttribute($value){
    return Carbon::parse($value)->format('d F Y H:i:s');
  }

}
