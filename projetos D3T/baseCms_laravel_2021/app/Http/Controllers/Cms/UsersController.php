<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\User;
use App\Group;

use App\Traits\UploadTrait;

class UsersController extends RestrictedController
{
    use UploadTrait;
    /**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
            "Usuários",
            [["icon" => "", "title" => "Usuários", "url" => ""]]
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
        $titles = json_encode(["#", "Nome", "E-mail", "Usuário"]);

        $busca = "";
        $items = User::select('id', 'name', 'email', 'username');
        if (!empty($request->busca)) {
            $busca = $request->busca;
            $items->where(function($query) use ($busca){
              $query->orWhere('id','like','%'.$busca.'%')
                ->orWhere('name','like','%'.$busca.'%')
                ->orWhere('email','like','%'.$busca.'%')
                ->orWhere('username','like','%'.$busca.'%');
            });
        }
        $items = $items->orderBy('id','DESC')->orderBy('id', 'desc')->paginate();

        $groups = json_encode(Group::select('id AS value', 'name AS label')->get());

        return view('cms.users.index', compact('headers', 'titles', 'items', 'groups', 'busca','actions'));
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

        $validation = $this->validation($data, 'store');
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

				$data['password'] = bcrypt($data['password']);

        $image = null;
        if (!empty($data['image'])) {
            if (!$image = $this->uploadValidFile('users', $data['image'])) {
                return response()->json(['errors' => 'image cannot be uploaded'], 406);
            }
        }
        $data['image'] = $image;

        $newUser = User::create($data);

        return redirect()->back()->with('message', 'Registro cadastrado com sucesso!');
    }

    /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
    public function edit(User $user)
    {
        #PAGE TITLE E BREADCRUMBS
        $headers = parent::headers(
            "Usuários",
            [
                ["icon" => "", "title" => "Usuários", "url" => route('users.index')],
                ["icon" => "", "title" => "Editar", "url" => ""]
            ]
        );

        $user->image = asset($user->image);

        $item = $user;

        $groups = json_encode(Group::select('id AS value', 'name AS label')->get());

        return view('cms.users.edit', compact('headers', 'item', 'groups'));
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        $data['id'] = $user->id;
        $validation = $this->validation($data, 'update');
        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $image = $user->image;
        if ($request->hasFile('image')) {
            if ($uploadedImage = $this->uploadValidFile('users', $data['image'])) {
                $image = $uploadedImage;
                if (!empty($user->image)) {
                    $this->deleteFile($user->image);
                }
            }
        }
        $data['image'] = $image;

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('message', 'Registro atualizado com sucesso!');
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
        $users = User::whereIn('id', $data['registro'])->get();
        foreach ($users as $user) {
            if (!empty($user->image)) {
                $this->deleteFile($user->image);
            }
            $user->delete();
        }

        return redirect()->back()->with('message', 'Itens excluídos com sucesso!');
    }

    /**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
    private function validation(array $data, $action)
    {
        $validation = [
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'username' => 'required|string|max:255|unique:users',
            'group_id' => 'required|integer|exists:groups,id',
            'image' => 'required|image',
            'description' => 'nullable|string',
        ];

        if ($action == 'update') {
            $validation['email'] = ['required', 'email', 'max:255', Rule::unique('users')->ignore($data['id'])];
            $validation['username'] = ['required', 'string', 'max:255', Rule::unique('users')->ignore($data['id'])];
            $validation['password'] = 'nullable|string|min:6';
            $validation['image'] = 'nullable|image';
        }

        return Validator::make($data, $validation);
    }
}
