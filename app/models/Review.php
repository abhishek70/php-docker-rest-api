<?php

namespace Models;

use Eloquent;

/**
 * Class Review
 *
 * @property-read  int    $id
 * @property       string $name
 * @property       string $email {@type email}
 * @property       string $message
 * @property-read  string $created_at {@type datetime}
 * @property-read  string $updated_at {@type datetime}
 * 
 */
class Review extends Eloquent
{
    
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'reviews';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'message'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
