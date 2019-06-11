<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function user_json_view(){
        $user = User::all();
        return DataTables::of($user)
            ->addColumn('action', function ($user) {
                return '<form method="post" action="'.route('user.destroy',$user->id).'">
<div class="ui buttons m-0">
'.csrf_field().method_field('delete').'
<a href="' . route('user.edit', $user->id) . '" class="mini ui button px-2 green"><i class="edit icon"></i></a>
<button class="mini ui button px-2 pink"><i class="remove icon"></i></button>
</div>
</form>';
            })
            ->editColumn('role',function ($user){
                return view('user.checkbox',compact('user'));
            })
            ->editColumn('profile',function ($user){
                return '<img class="ui image avatar" src="'.asset($user->profile).'" alt="">';
            })
            ->rawColumns(['role','action','profile'])
            ->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $input = $request->all();
        $user = new User();
        $user->name = $input['user_name'];
        $user->email = $input['email'];
        $user->profile = $input['profile'];
        $user->password = Hash::make($input['password']);
        $user->phone = $input['phone'];
        $user->save();
        if ($user){
            return redirect(route('user.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRole(Request $request, $id)
    {
        $input = $request->all();
        $user = User::findOrFail($id);
        if (isset($input['isAdmin'])){
            $user->role = 1;
        }else{
            $user->role = 0;
        }
        $user->save();
        if ($user){
            return redirect()->back();
        }
    }
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $user = User::findOrFail($id);
        $user->name = $input['user_name'];
        $user->email = $input['email'];
        $user->profile = $input['profile'];

        if ($input['password']!==null){
            $user->password = Hash::make($input['password']);
        }
        $user->phone = $input['phone'];
        $user->save();
        if ($user){
            return redirect(route('user.index'));
        }
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
}
