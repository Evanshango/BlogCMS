<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function __construct(){
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin.users.index')->with('users', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email:unique:users'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('123456')
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'avatar' => 'storage/profiles/account.png'
        ]);
        session()->flash('success', 'User created successfully');
        return redirect(route('users.index'));
    }

    public function admin($id)
    {
        $user = User::find($id);
        if ($user->admin == 0) {
            $user->admin = 1;
        } else {
            $user->admin = 0;
        }
        $user->save();

        session()->flash('success', 'User permission updated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $user->profile->delete();
        $user->delete();

        session()->flash('success', 'User deleted successfully');
        return redirect()->back();
    }
}
