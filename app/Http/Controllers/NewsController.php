<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $detik=5000;
        // $jam=intdiv($detik,3600);
        // $sisajam=$detik%3600;
        // $menit=intdiv($sisajam,60);
        // $sisadetik=$sisajam%60;
        // return "Jam =".$jam." Menit =".$menit." Detik=".$sisadetik;

        $data = Category::get();
        return view('news.index', compact('data'));
    }
    public function indexRestore()
    {

        // $detik=5000;
        // $jam=intdiv($detik,3600);
        // $sisajam=$detik%3600;
        // $menit=intdiv($sisajam,60);
        // $sisadetik=$sisajam%60;
        // return "Jam =".$jam." Menit =".$menit." Detik=".$sisadetik;

        $data = Category::get();

        return view('restore', compact('data'));
    }
    public function restoreData($id)
    {
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];

        // return response()->json($result);
        // $restore = News::onlyTrashed()->restore();
        $restore = News::where('id', $id)->onlyTrashed()->restore();
        // JIKA INGIN MERESTORE PER ID
        if ($restore) {
            $result = [
                'status' => true,
                'message' => "Success Restore Data",
                'data' => $restore,
            ];
            return response()->json($result);
        }
    }
    public function deletePermanentData()
    {
        $delete = News::where('id', '3')->forceDelete();
        if ($delete) {
            $result = [
                'messagge' => 'Success delete Permanent',
                'data' => $delete,
            ];
            return response()->json($result);
        }
    }
    public function getData(Request $r)
    {
        $id = $r->id;
        if ($id) {
            $data = News::where('id', $id)->first();
            $data->no = $no = 1;
        } else {
            $data = News::with('Category')->get();
            // $data = News::with('Category')->onlyTrashed()->get();
            // $data = News::with('Category')->withTrashed()->get();
            $no = 0;
            foreach ($data as $a) {
                $a->no = $no += 1;
                $a->tgl = date_format($a->created_at, "d-M-Y");
            }
        }
        $result = [
            "data" => $data,
        ];
        return response()->json($result);
    }
    //controller
    // public function getData(Request $r)
    // {
    //     $id = $r->id;
    //     if ($id) {
    //         $data = Tamu::where('id', $id)->first();
    //         $data->no = $no = 1;
    //     } else {
    //         $data = Tamu::get();
    //         // $data = News::with('Category')->onlyTrashed()->get();
    //         // $data = News::with('Category')->withTrashed()->get();
    //         $no = 0;
    //         foreach ($data as $a) {
    //             $a->no = $no += 1;
    //             // $a->tgl = date_format($a->created_at, "d-M-Y");
    //         }
    //     }
    //     $result = [
    //         "data" => $data,
    //     ];
    //     return response()->json($result);
    // }
    //model
    // protected $table = "study_kasus";
    // protected $id = "id";

    public function getDataRestore(Request $r)
    {
        $id = $r->id;
        if ($id) {
            $data = News::where('id', $id)->first();
            $data->no = $no = 1;
        } else {
            // $data = News::with('Category')->get();
            $data = News::with('Category')->onlyTrashed()->get();
            // $data = News::with('Category')->withTrashed()->get();
            $no = 0;
            foreach ($data as $a) {
                $a->no = $no += 1;
                $a->tgl = date_format($a->created_at, "d-M-Y");
            }
        }
        $result = [
            "data" => $data,
        ];
        return response()->json($result);
    }
    public function Create(Request $r)
    {
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];
        $data = new News();
        $data->title = $r->title;
        $data->description = $r->description;
        $data->id_category = $r->id_category;
        $data->save();
        // $category=News::Category()->name;

        $result['newToken'] = csrf_token();
        $result['status'] = true;
        $result['data'] = $data;
        // $result['category'] = $cate;
        $result['message'] = "Data Berhasil";
        return response()->json($result);
    }
    public function updateData(Request $r, $id)
    {
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];
        $data = News::where('id', $id)->first();
        if (!$data) {
            $result['message'] = "Category not found";
            return response()->json($result);
        }
        $cek = News::where('title', $r->title)->where('id', '!=', $id)->first();

        if ($cek) {
            $result['status'] = true;
            $result['message'] = "data gagal diisi karena kategori dengan judul yang sama sudah ada";
            return response()->json($result);
        } else {
            $data->title = $r->title;
            $data->description = $r->description;
            $data->id_category = $r->id_category;
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
            'newToken' => csrf_token(),
        ];
        $data = News::where('id', $id)->first();
        if (!$data) {
            $result['message'] = "Data not found";
            return response()->json($result);
        }
        $data->delete();
        $result['status'] = true;
        $result['message'] = "Category has been deleted";
        return response()->json($result);
    }
}
