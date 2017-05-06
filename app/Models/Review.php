<?php
/**
 * Created by PhpStorm.
 * User: Utilizador
 * Date: 06/05/2017
 * Time: 13:58
 */

namespace ventureoak\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';
    public $primaryKey = 'id';


    // Establishes the N:1 relationship with companies table
    public function company() {
        return $this->belongsTo('ventureoak\Models\Company', 'company_id');
    }


    /**
     * ACCESSOR
     * Calculate the rating average
     *
     * @return boolean
     */
    public function ratingAverage() {
       return ($this->rating_culture + $this->rating_management + $this->rating_work_live_balance + $this->rating_career_developmen)/4;
    }

}