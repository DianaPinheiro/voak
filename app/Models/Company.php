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

    // Establishes the 1:N relationship with reviews table
    public function reviews() {
        return $this->hasMany('ventureoak\Models\Review');
    }
}