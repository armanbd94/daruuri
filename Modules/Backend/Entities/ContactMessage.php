<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = ['name','email','phone','subject','message'];
}
