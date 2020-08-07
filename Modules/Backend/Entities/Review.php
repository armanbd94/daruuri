<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['name','phone_no','email','description',
    'daruuri_rating','communication_rating','stuff_rating','service_rating','referal_rating'];
}
