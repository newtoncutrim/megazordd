<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Group;
use App\Module;

class GroupsController extends RestrictedController
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		#PAGE TITLE E BREADCRUMBS
		$headers = parent::headers(
			"Grupos de Usuários",
			[["icon" => "", "title" => "Grupo de Usuários", "url" => ""]]
		);

		$actions = json_encode([
            [
              'path' => '{item}/edit',
              'icon' => 'fa fa-pencil',
              'label' => 'Editar',
              'color' => 'primary',
            ],
          ]);

        #LISTA DE ITENS
        $items_per_page = config('constants.options.items_per_page');
        $titles = json_encode(["#", "Nome"]);

        if(!empty($request->busca)){
			$busca = $request->busca;
			$items = Group::listItems($items_per_page, $busca);
        } else {
			$busca = "";
			$items = Group::listItems($items_per_page);
        }

        $modules = Module::getModules();

        return view('cms.groups.index', compact('headers', 'titles', 'items', 'modules', 'busca','actions'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
        $data = $request->all();

		if($this->validation($data)->fails())
			return redirect()->back()->withErrors($validation)->withInput();

		$group = Group::create($data);

		if(!empty($data['module_id'])){
			$group->modules()->attach($data['module_id']);
		}

		return redirect()->back()->with('message', 'Registro gravado com sucesso!');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		#PAGE TITLE E BREADCRUMBS
		$headers = parent::headers(
			"Grupos de Usuários",
			[
				["icon" => "", "title" => "Grupos de Usuários", "url" => route('groups.index')],
				["icon" => "", "title" => "Editar", "url" => ""]
			]
		);

        $item = group::find($id);

		if(empty($item))
			return redirect()->back();

		$modules = Module::getModules();

		$group_modules = $item->modules()->get();

		$group_modules_ids = [];
		foreach ($group_modules as $key => $value) {
			array_push($group_modules_ids, $value->id);
		}

		return view('cms.groups.edit', compact('headers', 'item', 'modules', 'group_modules_ids'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Group $group)
	{
        $data = $request->all();

        if($this->validation($data)->fails()) {
        return redirect()->back()->withErrors($validation)->withInput();
        }

        $group->update($data);

		$group->modules()->sync($data['module_id']);

		return redirect()->route('groups.index')->with('message', 'Registro atualizado com sucesso!');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Request $req)
	{
		$data = $req->all();
		$groups = Group::whereIn('id',$data['registro'])->get();
        foreach ($groups as $group) {
            $group->modules()->detach();
            $group->delete();
        }

        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
	}

	private function validation(array $data){
		return Validator::make($data, [
            'name' => 'required|string|max:255',
		]);
	}
}