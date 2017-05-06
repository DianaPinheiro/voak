<?php

Route::group([
    'prefix' => 'api/v1',
    'middleware' => ['api']
    ], function () {
        Route::get('companies', 'CompaniesController@viewAllCompanies');
        Route::get('companies/{id}/reviews', 'CompaniesController@viewReviewsOfSpecificCompany');
        Route::post('companies/{id}/reviews/', 'ReviewController@createReviewForCompany');
        Route::get('companies/{id}/reviews/minmax', 'ReviewController@getMinMaxReviewForCompany');
});