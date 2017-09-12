<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

trait ApiResponser
{
	private function successResponse($data, $code) {
		return response()->json(['data' => $data, 'total' => 1, 'status' => 'OK'], $code);
	}

	private function successResponses($data, $code) {
		return response()->json(['data' => $data, 'total' => $data->count(), 'status' => 'OK'], $code);
	}

	protected function errorResponse($message, $code) {
		return response()->json(['error' => $message, 'status' => 'ERROR'], $code);
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

	protected function errorMessage($data, $code) {
		return response()->json($data, $code);
	}
}