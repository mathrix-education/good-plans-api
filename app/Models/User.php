<?php


namespace App\Models;


use Carbon\Carbon;

/**
 * @property int            $id
 * @property string|null    $firstname
 * @property string|null    $lastname
 * @property string|null    $email
 * @property Carbon         $birthdate
 * @property string|null    $city
 * @property string|null    $universities
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 *
 */

class User
{
    /** @var bool If timestamps (created_at and updated_at) should be used */
    public $timestamps = true;

    /** @var array The guarded attributes */
    protected $fillable = [
        'email',
        'firstname',
        'lastname',
        'email',
        'birthdate',
        'city',
        'university',
    ];


}
