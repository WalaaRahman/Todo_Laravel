<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\userModel;

class UsersController extends Controller
{

    public  function __construct(){

        $this->middleware('userCheck',['except' => ['create','store','LoginView','Login']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd(request());
        $data=$this->validate($request,[
            "name"     => "required",
            "email"    => "required | email",
            "password" => "required | min:6"
        ]);
        
        #Hashing Password
        $data['password']=bcrypt($data['password']);

        $op=userModel::create($data);
        if($op){
            $message = "Data Inserted";
        }else{
            $message = "Error Try Again!!";
        }
  
      # Set Message To Session .... 
      session()->flash('Message',$message);

        return redirect(url('/user'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function LoginView(){
        return view('user.login');
    }

    public function Login(Request $request){
        $data = $this->validate($request,[

            "email" => "required|email",
            "password" => "required|min:6"
           ]);

        if(auth('web')->attempt($data)){
            return redirect(url('/task'));
        }else{
            return redirect(url('/user/login'));
        }   
    }
        public function LogOut () {
            auth()->guard('web')->logout();

            return redirect(url('/user/login'));
            }



}
