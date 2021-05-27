<?php

namespace Modules\Reference\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Reference\Traits\BindsDynamicallyTrait;
// use Sofa\Eloquence\Eloquence;

class RefGlobalSearch extends Model {
    
  use BindsDynamicallyTrait;
  // use Eloquence;

	public $searchableColumns = [];

	public function __construct(array $attributes = array())
	{
	    $this->searchableColumns = $attributes;
	}

  // public function ref_asset_gh() {
  //   return $this->hasOne('Modules\AssetMasterGh\Models\AssetMasterGh', 'id', 'bangunan_sipil_gardu') ;
  // }

}
