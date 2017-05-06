<?php


namespace ventureoak\Http\Controllers;

use Request;
use Response;
use ventureoak\Models\Company;
use ventureoak\Models\Review;
use ventureoak\Transformers\CompanyTransformer;
use ventureoak\Transformers\ReviewTransformer;

class CompaniesController extends ApiController
{

    protected $companyTransformer;
    protected $reviewTransformer;

    function __construct(CompanyTransformer $companyTransformer, ReviewTransformer $reviewTransformer)
    {
        $this->companyTransformer = $companyTransformer;
        $this->reviewTransformer = $reviewTransformer;
    }


    /**
     *  Show all companies and their average rating
     */
    public function viewAllCompanies()
    {
        $limit = Request::get('limit', 10); // If no limit is available assumes 10

        // Hard limits the number of items to 20
        if ($limit > 20) {
            $limit = 20;
        }

        $companies = Company::paginate($limit);

        return $this
            ->setStatusCode(200)
            ->respondWithPagination($companies, [
                'data' => $this->companyTransformer->transformCollection($companies->all()),
            ]);
    }

    /**
     *  Show all reviews by Company ID
     */
    public function viewReviewsOfSpecificCompany($id)
    {
        $limit = Request::get('limit', 10); // If no limit is available assumes 10

        // Hard limits the number of items to 20
        if ($limit > 20) {
            $limit = 20;
        }

        // Checks if company exists
        $company = Company::find($id);
        if ($company == null) {
            return $this->respondNotFound();
        }

        $reviews = Review::where('company_id', $id)->paginate($limit);

        return $this
            ->setStatusCode(200)
            ->respondWithPagination($reviews, [
                'data' => $this->reviewTransformer->transformCollection($reviews->all()),
            ]);

    }
}