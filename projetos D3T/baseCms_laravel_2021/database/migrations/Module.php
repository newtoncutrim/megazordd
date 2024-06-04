<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Module extends Model
{
    public static function getModules(){
    	return (new static)::whereRaw('LENGTH(father_path) = 0 OR father_path IS NULL ')
    			->orderBy('father_order','ASC')
    			->get();
    }
    
	/**
     * The module's submodules
     */
    public function submodules()
    {
        return $this->hasMany('App\Module', 'father_path', 'path')->orderBy('order');
    }

    /**
     * The events that belong to the usergroup.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_module');
    }
}
