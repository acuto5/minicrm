<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * @package App
 */
class Company extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
    ];
}
