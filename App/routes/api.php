<?php
/*
|--------------------------------------------------------------------------
| Api routing
|--------------------------------------------------------------------------
|
| Register it all your api routes
|
*/
$app->group('/api', function (){
	$this->group('/post', function () {
		$this->get('[/]', [\App\Controllers\Api\BlogApiController::class, 'all']);
		$this->get('/{id}', [\App\Controllers\Api\BlogApiController::class, 'view']);
		$this->post('/{id}', [\App\Controllers\Api\BlogApiController::class, 'update']);
		$this->delete('/{id}', [\App\Controllers\Api\BlogApiController::class, 'destroy']);
		$this->post('[/]', [\App\Controllers\Api\BlogApiController::class, 'store']);
	});
});
