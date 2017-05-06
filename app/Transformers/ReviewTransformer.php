<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 06/05/2017
 * Time: 16:17
 */

namespace ventureoak\Transformers;


class ReviewTransformer extends Transformer {

    /**
     * This method maps a company between field names in the database and responses sent to the API
     *
     * @param $review
     * @return array
     */
    public function transform($review) {
        return [
            'title' => $review['title'],
            'user' => $review['user_email'],
            'rating_culture' => $review['rating_culture'],
            'rating_management' => $review['rating_management'],
            'rating_work_live_balance' => $review['rating_work_live_balance'],
            'rating_career_development' => $review['rating_career_development']
        ];
    }

}