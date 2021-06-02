<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Reference\Traits\BindsDynamicallyTrait;

class RefGlobalSearch extends Model {
    
  use BindsDynamicallyTrait;

	public $searchableColumns = [];

	public function __construct(array $attributes = array())
	{
	    $this->searchableColumns = $attributes;
	}


}
