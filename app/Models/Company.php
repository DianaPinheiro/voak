<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 06/05/2017
 * Time: 13:58
 */

namespace ventureoak\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';
    public $primaryKey = 'id';
    protected $appends = ['companyRatingAverage'];

    // Establishes the 1:N relationship with reviews table
    public function reviews() {
        return $this->hasMany('ventureoak\Models\Review');
    }

    /**
     * ACCESSOR
     * Calculate the rating average
     *
     * @return boolean
     */
    public function getCompanyRatingAverageAttribute() {
        $reviewsSum = 0;
        foreach ($this->reviews as $review ){
            $reviewsSum += $review->rating_average;
        }

        return $reviewsSum/$this->reviews->count();
    }
}