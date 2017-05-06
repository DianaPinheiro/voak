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
    protected $appends = ['RatingAverage'];


    // Establishes the N:1 relationship with companies table
    public function company() {
        return $this->belongsTo('ventureoak\Models\Company', 'company_id');
    }
}