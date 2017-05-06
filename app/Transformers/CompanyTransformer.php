<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 06/05/2017
 * Time: 16:17
 */

namespace ventureoak\Transformers;


class CompanyTransformer extends Transformer {

    /**
     * This method maps a company between field names in the database and responses sent to the API
     *
     * @param $company
     * @return array
     */
    public function transform($company) {
        return [
            'name' => $company['name'],
            'slug' => $company['slug'],
            'city' => $company['slug'],
            'country' => $company['country'],
            'industry' => $company['industry'],
            'average_rating' => number_format($company['companyRatingAverage'],2)
        ];
    }

}