<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Profile;
use Carbon\Carbon;


class profileController extends Controller
{
    public function validate_Request(Request $request){
        $validator = Validator::make($request->all(),
        [
            'username'=>'required|max:100',
            'perfil'=>'required|max:255'

        ]);
        return $validator;
    }
    public function index()
    {
        $profiles = Profile::all();
       
        return  response()->json($profiles->toArray(),201);
    }

    public function init(){
        //
    }

    public function Search($params){

       $result  =  DB::table('profiles')
        ->where('username', 'LIKE', '%' . $params . '%')
        ->get();

        // $result = [
        //     ['label' => 'Victor', 'value' => 1],
        //     ['label' => 'Viviane', 'value' => 2],
        //     ['label' => 'Vair', 'value' => 3],
        // ];
        
        return  response()->json($result,201);
    }

    public function store(Request $request)
    {
        
        $errors  = $this->validate_Request($request);
        if($errors->fails()){
            return response()->json($errors->fails(),400);
        } else {
            $Profile = new Profile;
            $Profile->username = $request->username;
            $Profile->perfil = $request->perfil;
            $Profile->created_at = Carbon::now();
            $Profile->save();

            
            return response()->json($Profile->id,200);
        }

    }

    public function edit($id)
    {
        $Profile = Profile::findOrFail($id);
        return response()->json($Profile, 200);
    }

    public function editar(Request $request, $id){
        $errors  = $this->validate_Request($request);
        if($errors->fails()){
            return response()->json($errors->fails(),400);
        } else {
            $Profile = Profile::findOrFail($id);
            $Profile->username = $request->username;
            $Profile->perfil = $request->perfil;
            $Profile->created_at = Carbon::now();
            $Profile->save();
            return response()->json($request->all(),200);
        }
    }

    public function delete($id){
        $result  = Profile::find($id)->delete();
        $profile_result = Profile::all();
        if($result){
            $data = [
                'status'=> '1',
                'msg'=>'delete success'
            ]; 
            return response()->json($profile_result);
        } else {
            $$data = [
                'status'=> '0',
                'msg'=>'fails delete'
            ];    
            return response()->json($data, 200);
        }
    }
}
