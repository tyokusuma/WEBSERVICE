<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	private function successResponse($data, $code) {
		return response()->json(['data' => $data, 'total' => 1], $code);
	}

	private function successResponses($data, $code) {
		return response()->json(['data' => $data, 'total' => $data->count()], $code);
	}

	protected function errorResponse($message, $code) {
		return response()->json(['error' => $message, 'code' => $code], $code);
	}

	protected function showAll(Collection $collection, $code = 200) {
		return $this->successResponses($collection, $code);
	}

	protected function showOne(Model $model, $code = 200) {
		return $this->successResponse($model, $code);
	}

	protected function showMessage($message, $code = 200)
	{
		return $this->successResponse($message, $code);
	}

	protected function showAllNew($collection, $code = 200) {
		return $this->successResponses($collection, $code);
	}

	protected function onlyMessage($data, $code = 200) {
		return response()->json(['data' => $data], $code);
	}
}