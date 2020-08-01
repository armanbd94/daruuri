<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['brand_id','category_id','product_name','product_image','description'];
}
