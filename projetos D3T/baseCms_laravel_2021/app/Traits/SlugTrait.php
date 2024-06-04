<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SlugTrait
{
    public function getSlug($name, $tableName, $slugFieldName = 'slug', $itemId = null)
    {
        $slug = str_slug($name, '-');
        $count = 1;
        while (true) {
            if ($this->validateSlug($slug, $tableName, $slugFieldName, $itemId) == 0) {
                return $slug;
            }

            $slug = $slug . '-' . $count;
            $count++;
        }
    }

    /**
     * return a count of constructions with the slug
     * @param $slug
     * @return mixed
     */
    public function validateSlug($slug, $tableName, $slugFieldName, $itemId)
    {
        if ($itemId !== null) {
            return DB::table($tableName)->where($slugFieldName, $slug)->where('id', '<>', $itemId)->count();
        }

        return DB::table($tableName)->where($slugFieldName, $slug)->count();
    }
}
