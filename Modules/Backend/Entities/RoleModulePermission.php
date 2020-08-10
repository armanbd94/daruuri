<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;

class RoleModulePermission extends Model
{
    protected $fillable = [];

    public function module(){
        return $this->belongsTo(Module::class);
    }
}
