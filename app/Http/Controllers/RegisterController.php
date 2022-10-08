<?php

namespace App\Http\Controllers;

use App\Models\Register;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register');
    }
    public function getData()
    {
        $user = auth()->user();
        $id = $user->id;
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];
        $result['status'] = true;
        $result['data'] = $user;
        return response()->json($result);
    }
    public function create(Request $r)
    {
        $password = $r->password;
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];
        $cek = User::where('email', $r->email)->first();
        if ($cek) {
            $result['status'] = true;
            $result['message'] = 'data gagal disi, email sama';
            return response()->json($result);
        }
        $data = new User();
        $data->name = $r->name;
        $data->email = $r->email;
        $data->password = Hash::make($password);
        $data->save();
        // $category=News::Category()->name;

        $result['newToken'] = csrf_token();
        $result['status'] = true;
        $result['data'] = $data;
        $result['message'] = 'created user success!!!';
        return response()->json($result);
    }

    public function update(Request $r, $id)
    {
        // $id=$r->id;
        $result = [
            'status' => false,
            'data' => null,
            'message' => '',
            'newToken' => csrf_token(),
        ];
        // $check = Category::where('name', $r->name)->first();
        $data = User::where('id', $id)->first();
        //cpanel
        if (!$data) {
            $result['message'] = 'User not found';
            return response()->json($result);
            return view('register');
        }
        $cek = User::where('email', $r->email)
            ->where('id', '!=', $id)
            ->first();
        if ($cek) {
            $result['status'] = true;
            $result['message'] = 'data gagal disi User account sudah ada';
            return response()->json($result);
        } else {
            $data->name = $r->name;
            $data->email = $r->email;
            $data->save();

            $result['status'] = true;
            $result['data'] = $data;
            $result['message'] = 'Update User Acciunt Successfully';
            // return view('/profile');
        }
        return response()->json($result);
    }

    public function updatePassword(Request $request, $id)
    {
        $result = [
            'message'=>'',
            'data'=>null,
            'status'=>false,
            'newToken'=>csrf_token(),
        ];

        $data = User::find(Auth::user()->id);

        // $pn = Hash::make("123123");
        // dd(Hash::check('123123', $data->password));
        if(Hash::check($request->oldPassword,  $data->password)){

            $oldPassword = Hash::make($request->oldPassword);
            if(Hash::check($request->password, $oldPassword)){
                $result['message'] = "Password baru anda sama dengan yang lama!!";
                return response()->json($result);
            }else{
                $newPassword = Hash::make($request->newPassword);
                if(Hash::check($request->confirmPassword, $newPassword)){
                    $data->password = Hash::make($request->confirmPassword);
                    $data->update();
                    $result['password']=$request->all();
                    $result['message'] = "Data password berhasil di update!";
                    $result['status'] = true;
                    $result['data'] = $data;
                    return response()->json($result);

                }else{
                    $result['message'] = "Password anda tidak sama dengan new password!!";
                    return response()->json($result);
                }
            }
        }else{
            $result['message'] = "Password anda tidak diketeahui!!";
            return response()->json($result);
        }

        //     $result = [
        //         'status' => false,
        //         'data' => null,
        //         'message' => '',
        //         'newToken' => csrf_token()
        //     ];
        //     $password_lama = $r->old_password;
        //     $password = $r->password;
        //     $rePassword=$r->repassword;
        //     // $data = User::where('id', $id)->first();
        //     return $data;
        //     if (!$data) {
        //         $result['message'] = "User not found";
        //         return response()->json($result);
        //     }
        //     $data=User::find(Auth::user()->id);

        //     if(Hash::check($password_lama, $data->password)) {
        //         $oldPassword=Hash::make($$password_lama);
        //         if

        //     }
        //     return response()->json($result);
    }
}
