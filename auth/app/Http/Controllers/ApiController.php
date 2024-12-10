<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use App\Models\User;



class ApiController extends Controller
{
    public function register(Request $request)
    {
        // Use the Validator facade for validation
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:4',
            'c_password' => 'required|same:password',
        ]);
    
        // Return validation errors if validation fails
        if ($validation->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validation->errors()], 401);
        }
    
        // Collect and process data
        $data = $request->all();
        $data['password'] = Hash::make($data['password']); 
    
        // Create the user
        $user = User::create($data);
    
        // Generate a personal access token
        $response['token'] = $user->createToken('myapp')->plainTextToken; 
        $response['name'] = $user->name;
    
        // Return a success response
        return response()->json($response, 200);
    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
            $user=Auth::user();
            $response['token'] =$user->createToken('myapp')->plainTextToken;
            $response['name'] =$user->name;
            return response()->json($response,200);
        }
        else{
            return rseponse()->json(['message'=>'Provided email address or password is incorrect'],401);
        }
    }

    public function userlist(Request $request){

        $user =Auth::user();
        $response['user'] =$user;
        return response()->json($response,200);
    }
    //testing git
    public function userlist1(Request $request){

        $user =Auth::user();
        $response['user'] =$user;
        return response()->json($response,200);
    }
}
