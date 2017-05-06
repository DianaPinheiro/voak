<?php


namespace ventureoak\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Validator;
use Response;
use ventureoak\Models\Company;
use ventureoak\Models\Review;
use ventureoak\Transformers\ReviewTransformer;
use Illuminate\Http\Response as IlluminateResponse;


class ReviewController extends ApiController
{

    protected $reviewTransformer;

    function __construct(ReviewTransformer $reviewTransformer)
    {
        $this->reviewTransformer = $reviewTransformer;
    }

    /**
     * Create a new review
     *
     * @param $id - Company ID
     * @param Request $request
     * @return JSON
     */
    public function createReviewForCompany($id, Request $request)
    {
        // TODO: Finnish this validator
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'body' => 'required'
        ]);
        if ($validator->fails()) {
            return $this
                ->setStatusCode(IlluminateResponse::HTTP_UNPROCESSABLE_ENTITY)
                ->respond(null);
        }

        // Checks if company exists
        $company = Company::find($id);
        if ($company == null) {
            return $this->respondNotFound();
        }

        // Checks if the user has made a previous review for this company
        $review = Review::where('company_id', $id)
            ->where('user_email', $request->get('userEmail'))
            ->first();
        if ($review != null) {
            return $this
                ->setStatusCode(IlluminateResponse::HTTP_CONFLICT)
                ->respond(null);
        }

        // Create a new review
        $review = new Review();
        $review->company_id = $id;
        $review->title = $request->get('title');
        $review->user_email = $request->get('userEmail');
        $review->rating_culture = $request->get('reviewRatingCulture');
        $review->rating_management = $request->get('reviewRatingManagement');
        $review->rating_work_live_balance = $request->get('reviewRatingWorkLiveBalance');
        $review->rating_career_development = $request->get('reviewRatingCareerDevelopment');
        $review->pro = $request->get('pro');
        $review->contra = $request->get('contra');
        $review->suggestions = $request->get('suggestions');
        $review->save();

        return $this
            ->setStatusCode(IlluminateResponse::HTTP_CREATED)
            ->respond(null);
    }

    /**
     * List the review with the highest and the lowest rating for a particular company
     *
     * @param $id - Company ID
     * @return JSON
     */
    public function getMinMaxReviewForCompany($id)
    {
        // Checks if company exists
        $company = Company::find($id);
        if ($company == null) {
            return $this->respondNotFound();
        }

        $minReview = Review::where('company_id', $id)
            ->orderBy('rating_average', 'asc')
            ->first();

        $maxReview = Review::where('company_id', $id)
            ->orderBy('rating_average', 'desc')
            ->first();

        $reviews = new Collection();
        $reviews->push($minReview);
        $reviews->push($maxReview);

        $transformedReviews = $this->reviewTransformer->transformCollection($reviews->All());

        $reviewsToSend['minReview'] = $transformedReviews[0];
        $reviewsToSend['maxReview'] = $transformedReviews[1];

        return $this
            ->setStatusCode(IlluminateResponse::HTTP_OK)
            ->respond($reviewsToSend);
    }
}