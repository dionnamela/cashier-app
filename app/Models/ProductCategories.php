<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    protected $guarded = ['id'];
    protected $table = 'product_categories';
    protected $fillable = ['name'];
}
