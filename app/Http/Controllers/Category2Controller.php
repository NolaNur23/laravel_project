<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Category2Controller extends Controller
{
    public function index()
    {
        return view('category2.index');
    }


    public function getData(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $data = Category::where('id', $id)->first();
        } else {
            $data = Category::with('news')->get();
            $no = 0;

            foreach ($data as $d) {
                $d->no = $no += 1;
            }
        }
        $result = [
            "data" => $data
        ];
        return response()->json($result);
    }
    public function createData(Request $request)
    {
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token()
        ];
        $cek = Category::where('name', $request->name)->first();
        if ($cek) {
            $result['status'] = true;
            $result['message'] = "data gagal disi";
            return response()->json($result);
            // session()->flash('message', "Category $request->name sudah ada");
            // return redirect('/category');
            # code...-
        }
        $data = new Category();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();

        $result['newToken'] = csrf_token();
        $result['status'] = true;
        $result['data'] = true;
        $result['message'] = "data berhasil disi";
        return response()->json($result);
    }
    public function updateData(Request $r, $id)
    {
        // $id=$r->id;
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token()
        ];
        // $check = Category::where('name', $r->name)->first();
        $data = Category::where('id', $id)->first();
        //cpanel
        if (!$data) {
            $result['message'] = "Category not found";
            return response()->json($result);
        }
        $cek = Category::where('name', $r->name)->where('id', '!=', $id)->first();
        if ($cek) {
            $result['status'] = true;
            $result['message'] = "data gagal disi nama kategori sudah ada";
            return response()->json($result);
        } else {
            $data->name = $r->name;
            $data->description = $r->description;
            $data->is_active = $r->is_active;
            $data->save();

            $result['status'] = true;
            $result['data'] = $data;
            $result['message'] = "Update Category Successfully";
        }
        return response()->json($result);
    }
    public function deleteData($id)
    {
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token()
        ];
        $data = Category::where('id', $id)->first();
        if (!$data) {
            $result['message'] = "Category not found";
            return response()->json($result);
        }
        $data->delete();
        $result['status'] = true;
        $result['message'] = "Category has been deleted";
        return response()->json($result);
    }
    // public function saveData(Request $request)
    // {
    //     $id = $request->id;
    //     $result = [
    //         'status' => false,
    //         'data' => null,
    //         'message' => '',
    //         'newToken' => csrf_token()
    //     ];
    //     $cek = Category::where('name', $request->name)->where('id', '!=', $id)->first();
    //     if ($cek) {
    //         $result['status'] = true;
    //         $result['message'] = "data gagal disi";
    //         return response()->json($result);
    //     }
    //     $data = new Category();
    //     $data->name = $request->name;
    //     $data->description = $request->description;
    //     $data->save();

    //     $result['newToken'] = csrf_token();
    //     $result['status'] = true;
    //     $result['data'] = true;
    //     $result['message'] = "data berhasil disi";
    //     return response()->json($result);
    // }
}
