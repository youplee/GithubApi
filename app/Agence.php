<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agence extends Model
{
    protected $connection = 'mysql2';
    
    /**
     * @var string
     */
    protected $table = 'agences';

        /**
     * @var array
     */
    protected $fillable = ['name'];
}
