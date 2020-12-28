<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::orderBy('level')->get()->groupBy('level');
        return view('admin.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user_id) {
            $user = User::find($request->user_id);
            if ($user->username != $request->username) {
                $this->validate($request, [
                    'name' => 'required',
                    'username' => 'required|unique:users',
                ]);
            } else {
                $this->validate($request, [
                    'name' => 'required',
                ]);
            }
        } else {
            $this->validate($request, [
                'name' => 'required',
                'username' => 'required|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);
        }

        if ($request->password) {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => "Admin",
            ];
        } else {
            $data = [
                'name' => $request->name,
                'username' => $request->username,
                'role' => "Admin",
            ];
        }


        User::updateOrCreate(
            [
                'id' => $request->user_id
            ],
            $data
        );

        if ($request->user_id) {
            return redirect()->route('user.show', $user->level)->with('success', 'User Admin berhasil diperbarui!');
        } else {
            return redirect()->back()->with('success', 'User Admin berhasil ditambahkan!');
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
        $user = User::where('level', $id)->get();
        $level = $id;
        return view('admin.user.show', compact('user', 'level'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
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
        User::find($id)->delete();
        return redirect()->back()->with('success', 'Data user berhasil dihapus!');
    }

    public function reset($id)
    {
        $user = user::findorfail($id);
        if ($user->level != "Admin") {
            if ($user->level == "Guru") {
                $password = Hash::make('guru@123');
            } elseif ($user->level == "Siswa") {
                $password = Hash::make('siswa@123');
            } elseif ($user->level == "Wali Kelas") {
                $password = Hash::make('wali@' . $user->username);
            }

            $user->update(['password' => $password]);

            return redirect()->back()->with('success', 'User ' . $user->name . ' berhasil direset!');
        } else {
            return redirect()->back();
        }
    }
}
