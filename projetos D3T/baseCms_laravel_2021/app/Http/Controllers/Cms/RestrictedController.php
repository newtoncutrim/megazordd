<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

use App\Group;

class RestrictedController extends Controller
{
    function __construct() {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            if (!$this->checkModule($request)) {
                return redirect()->back()->with('error', 'Módulo não autorizado');
            }
            $data = [
                "request" => $request,
                "logos" => $this->setLogo(),
                "modules" => $this->makeMenu()
            ];

            View::share('data', $data);

            return $next($request);
        });
    }

    protected function headers($title, $moduleBreadcrumb = null)
    {
        $breadcrumb = [
            ["icon" => "fa fa-dashboard", "title" => "Dashboard", "url" => ""]
        ];
        if (!is_null($moduleBreadcrumb)) {
            $breadcrumb = [
                ["icon" => "fa fa-dashboard", "title" => "Dashboard", "url" => ""]
            ];
            $breadcrumb = array_merge($breadcrumb, $moduleBreadcrumb);
        }
        return json_encode([
            "title" => $title,
            "subtitle" => "",
            "breadcrumb" => $breadcrumb
        ]);
    }

    private function listManageableEvents()
    {
        $events = $this->user->events()->get();

        $eventsDropdown = [];
        foreach ($events as $key => $value) {
            array_push(
                $eventsDropdown,
                [
                    'id' => $value->id,
                    'text' => $value->name
                ]
            );
        }

        return $eventsDropdown;
    }

    private function getCurrentEventId()
    {
        $currentEvent = $this->user
            ->current_event()
            ->get();

        if (sizeof($currentEvent) == 0) {
            return 0;
        }
        return $currentEvent[0]->id;
    }

    private function setLogo()
    {
        $logos = [
            "logo200" => asset('img/logo_topo.png'),
            "logo50" => asset('img/logo_topo.png'),
        ];
        return $logos;
    }

    private function makeMenu()
    {
        $userGroup = $this->user
            ->group()
            ->get();
        $groupMenu = $userGroup[0]
            ->menu();
        return $groupMenu;
    }

    private function checkModule($request)
    {
        $userGroup = $this->user
            ->group()
            ->get();
        $allowedModules = $userGroup[0]
            ->modules()
            ->get();

        $continue = false;
        foreach ($allowedModules as $key => $value) {
            if (empty($value->father_path)) {
                if ($request->is('cms/'.$value->path . "*")) {
                    $continue = true;
                }                
            }
        }

        //If the father module is not allowed
        if (!$continue) {
           return false;
        }

        foreach ($allowedModules as $key => $value) //Check submodule permission
        {
            if(!empty($value->father_path))
            {
                if($request->is($value->father_path . '/' . $value->path . "*")){
                    return true;
                }                
            }
        }

        return $continue;
    }
}
