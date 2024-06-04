<?php

namespace App\Http\Middleware;

use Closure;
use App\Log;

class Logs
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    return $next($request);
  }

  public function terminate($request, $response)
    {
        
        $request_json = '';
        if (!empty($request->all())) {
            $request_json = $request->all();

            if (!is_string($request_json)) {
                $request_json = json_encode($request_json);
            }
        }

        $response_json = '';
        if (!empty($response->content())) {
            $response_json = $response->content();

            if (!is_string($response_json)) {
                $response_json = json_encode($response_json);
            }
        }

        // if($request->header('Authorization') != null){
        //     $token = $request->header('Authorization');
        // }else{
        //     $token = 'n_informado';
        // }

        Log::create([
            // 'auth' => $token,
            'url' => $request->path(),
            'method' => $request->method(),
            'request_json' => addslashes($request_json),
            'response_json' => "" . addslashes($response_json),
            'status' => $response->getStatusCode(),
            'ip_address' => $request->getClientIps()[0],
        ]);
    }
}
