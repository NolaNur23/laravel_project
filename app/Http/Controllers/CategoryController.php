<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if( Auth::user()){
            $data = Category::paginate(3);
            // $data = "Category";
            return view('category.index', compact('data'));

        }
        return redirect('/login');
    }
    public function create()
    {
        return view('category.create');
    }
    public function store(Request $request)
    {
        $cek = Category::where('name', $request->name)->first();
        if ($cek) {
            session()->flash('message', "Category $request->name sudah ada");
            return redirect('/category');
            # code...-
        }
        $category = new Category();
        $category->name = $request->name;
        $category->is_active = $request->is_active;
        $category->description = $request->description;
        $category->save();
        return redirect('/category');
    }
    public function searchData(Request $request){
        $data=Category::where('name', 'LIKE', '%' . $request->search. '%')->paginate(3);
        return view('category.index', compact('data'));
    }
    public function edit($id){

        $data=Category::where('id',$id)->first();
        return view('category.edit',compact('data'));
    }
    public function update(Request $request,$id){
        $validate= Category::where('name',$request->name)->where('id','!=',$id)->first();
        if($validate){
            // session->flash('message',"Data $request->name sudah ada,Silahkan Coba Lagi");
            return redirect('/category');
        }
        $data=Category::where('id',$id)->first();
        $data->name=$request->name;
        $data->description=$request->description;
        $data->is_active=$request->is_active;
        $data->update();
        return redirect('/category');

        // $cek = Category::where('name', $request->name)->first();
        // $data=Category::where('id',$id)->first();
    //     if ($cek) {
    //         if($cek->id==$id){

    //             $data->name=$request->name;
    //             $data->description=$request->description;
    //             $data->update();
    //             return
    //             redirect('/category');
    //         }else{
    //             session()->flash('message', "Category $request->name sudah ada");
    //             return redirect('/category');
    //         }
    //     }
    //             $data->name=$request->name;
    //             $data->description=$request->description;
    //             $data->update();
    //             return
    //             redirect('/category');
    }
    public function destroy($id) {
        $data=Category::where('id',$id)->get('name')->first();
        $cek=Category::where('id',$id)->delete();

        session()->flash('message', "Data $data->name sudah terhapus");
        return redirect('/category');


    }
}
