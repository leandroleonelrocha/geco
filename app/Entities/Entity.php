<?php
/**
 * Created by PhpStorm.
 * User: llrocha
 * Date: 18/04/2016
 * Time: 12:07
 */

namespace App\Entities;


use Illuminate\Database\Eloquent\Model;

class Entity extends Model {

    public static function getClass()
    {
        return get_class(new static);
    }
}