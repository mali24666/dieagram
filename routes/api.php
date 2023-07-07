<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Station
    Route::apiResource('stations', 'StationApiController');

    // Ct
    Route::apiResource('cts', 'CtApiController');

    // Diagram
    Route::apiResource('diagrams', 'DiagramApiController');

    // Rmu
    Route::apiResource('rmus', 'RmuApiController');
});
