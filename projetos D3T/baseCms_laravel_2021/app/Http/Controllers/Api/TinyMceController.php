<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TinyMceController extends Controller
{
    public function uploadImage(Request $request)
    {
        $imgpath = $request->file('file')->store('TinyMce', 'public');
        return response()->json(['location' => "/storage/$imgpath"]);
    }

    public function removeImage(Request $request)
    {
        $data = $request->all();
        try {
            if ($data['image']) {
                $data['image'] = $_SERVER['DOCUMENT_ROOT'] . parse_url($data['image'],PHP_URL_PATH);
            }
            unlink($data['image']);
        } catch (\Throwable $th) {
            return response()->json(['msg' => $th->getMessage()]);
        }
        return response()->json(['msg' => 'midia removida']);       
    }
}
