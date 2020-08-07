<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Page extends Model
{
    protected $fillable = ['title','image','description'];

    protected const CACHE_NAME    = '_pages';

    /*************************************
    * TODO =  Begin :: Cache Data = TODO *
    **************************************/

    public static function hardwareSoftwareService(){
        return Cache::rememberForever(self::CACHE_NAME, function () {
            return self::toBase()->select('id','title','image','description')->whereIn('id',[2,3])->get();
        });
    }

    public static function flushCache(){
        Cache::forget(self::CACHE_NAME);
    }

    public static function boot(){
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function() {
            self::flushCache();
        });

        static::deleted(function() {
            self::flushCache();
        });
    }
    /***********************************
    * TODO =  End :: Cache Data = TODO *
    ************************************/

}
