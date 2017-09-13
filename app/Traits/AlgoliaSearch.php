<?php

namespace App\Traits;

use App\Category;
use Illuminate\Http\Request;


trait AlgoliaSearch
{
	protected function search($request) 
	{
		$category_id = Category::search($request)->get();
		return $category_id;
	}
}