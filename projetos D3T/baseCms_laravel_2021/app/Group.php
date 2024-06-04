<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Group extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
      'name',
	];

	public static function listItems($search = null)
	{
  		if($search){
			$items = DB::table('groups')
			->select('id','name')
			->where(function($query) use ($search){
				$query->orWhere('id','like','%'.$search.'%')
					->orWhere('name','like','%'.$search.'%');
			})
			->orderBy('id','DESC')
			->paginate();
		}else{
			$items = DB::table('groups')
			->select('id','name')
			->orderBy('id','DESC')
			->paginate();
		}

		return $items;
	}

	/**
	 * The events that belong to the usergroup.
	 */
	public function modules()
	{
		return $this->belongsToMany('App\Module', 'group_module');
	}

	/**
	 * The users that belong to the usergroup
	 */
	public function users()
	{
		return $this->hasMany('App\User');
	}

	/**
	 * Generate the menu to the group
	 */
	public function menu()
	{
		$modules = $this->belongsToMany('App\Module', 'group_module')->orderBy('father_order')->orderBy('order')->get();

		$menuFathers = [];
		foreach ($modules as $key => $value) {
			if(strlen($value->father_path) == 0){
				$value->submodules = [];
				array_push($menuFathers, $value);
			}
		}

		$submodules = [];
		foreach ($modules as $key => $value) {
			if (strlen($value->father_path) > 0) {
				if(in_array($value->father_path, array_keys($submodules)))
				{
					array_push($submodules[$value->father_path], $value);
				}
				else
				{
					$submodules[$value->father_path] = [$value];
				}
			}
		}

		foreach ($menuFathers as $key => $value) {
			if($value->has_son){
				if(isset($submodules[$value->path]))
					$menuFathers[$key]->submodules = $submodules[$value->path];
				else
					unset($menuFathers[$key]);
			}
		}

		return $menuFathers;
	}
}