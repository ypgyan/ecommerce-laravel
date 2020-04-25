<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    /**
     * Não incrementar a chave primária
     *
     * @var boolean
     */
    public $incrementing = false;
}
