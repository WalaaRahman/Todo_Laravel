<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\taskModel;
use App\Models\userModel;


class taskController extends Controller
{

    public  function __construct(){

        $this->middleware('userCheck');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loggedIn_id=auth()->user()->id;
        $user_data=userModel::where('id',$loggedIn_id)->get();
        // dd($user_data);
        $user_name=$user_data[0]->name;
        // $data=taskModel::select('task.*','users.name')-> join ('users','users.id','=','task.user_id')->get();

        // $data=taskModel::get();
        $data=taskModel::where('user_id',$loggedIn_id)->get();
        return view('task.index',['data'=> $data, 'userName' => $user_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id=auth()->user()->id;
        $data=$this->validate($request,[
            'title' => "required",
            'description' => "required |min:10",
            'start_date' =>"required",
            'end_date' =>"required"
        ]);
        $data['start_date']=strtotime($data['start_date']);
        $data['end_date']=strtotime($data['end_date']);
        $data['user_id']=$user_id;
        //
        // dd(request());
        // dd($request->file->getClientOriginalName('daisy.jpg'));
        //  dd($request->image->getClientOriginalName());
        // dd($data);
        $op=taskModel::create($data);
        if($op){
            $message = "Task is Added";
        }else{
            $message = "Error Adding Task... Try Again!!";
        }

        return redirect(url('/task'));
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
        # Fetch Admin Data ... 
       $Taskdata = taskModel::where('id',$id)->get();

       return view('task.edit',['task' => $Taskdata]);
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
        $data=$this->validate($request,[
            'title' => "required",
            'description' => "required |min:10",
            'start_date' =>"required",
            'end_date' =>"required"
        ]);
        $data['start_date']=strtotime($data['start_date']);
        $data['end_date']=strtotime($data['end_date']);
        
        $op=taskModel::where('id',$id)->update($data);
        if($op){
            $message = "Task is Updated";
        }else{
            $message = "Error Updating Task... Try Again!!";
        }
        session()->flash('Message',$message);
        return redirect(url('/task'));   
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
        $row=taskModel::where('id',$id)->get();
        // dd($row[0]->end_date);
        $current_time=time();
        if($row[0]->end_date > $current_time){
            $op=taskModel::where('id',$id)->delete();

            if($op){
                $message="Task Deleted Successfully";
            }else{
                $message="Error Deleting Task !!!";

            }
            
        }else
        {
            $message="Late Submit";
        }
        session()->flash('Message',$message);
            return back();
    }

   
}
