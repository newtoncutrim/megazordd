<?php

namespace App\Helpers;

class JwtHelper
{
	
	public static function cliente()
	{
		if (request()->user('api')) {
			return request()->user('api')->cliente() ?: null;
		}

		return null;
	}

}
