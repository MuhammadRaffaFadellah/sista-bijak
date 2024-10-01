<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use App\Models\rw;

class ManagementController extends Controller
{
    public function users_management()
    {
        $users = User::whereIn('role_id', [1, 2])->paginate(5);
        return view('management-user.user-management', compact('users'));
    }

    public function form_add_users()
    {
        $users = User::get();
        $roles = Role::get();
        $rw_id = Rw::get(); // pastikan ini menggunakan model Rw yang benar

        // Mengatur data yang dikirim ke view
        return view('management-user.form-add-user', [
            'users' => $users,
            'roles' => $roles,
            'rw_id' => $rw_id
        ]);
    }
    public function process_add_users(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'rw_id' => 'required|exists:rw,id', // pastikan rw_id ada di tabel rw
        ]);
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'rw_id'     => $request->rw_id,
            'role_id'   => 2,
        ]);
        return redirect('/form-add-user');
    }
    public function form_edit_users($id) {
        $users = User::where('id', $id)->first(); // Ubah dari where ke find
        $roles = Role::all();     // Mengambil semua role
        $rw = Rw::all();          // Mengambil semua RW
        return view("management-user.form-edit-user", compact('users', 'roles', 'rw'));
    }
    public function process_edit_users(Request $request) {
        // Cari user berdasarkan ID
        $users = User::find($request->id);
        // Jika user tidak ditemukan, berikan pesan error atau redirect
        if (!$users) {
            return redirect()->back()->withErrors(['User tidak ditemukan.']);
        }
        // Validate data user
        $request->validate([
            'id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'rw_id' => 'required|exists:rw,id',
            'role_id' => 'required|exists:roles,id',
        ]);        
        // Update data user
        $users->name        = $request->name;
        $users->email       = $request->email;
        // Pastikan untuk meng-hash password jika diubah
        if ($request->filled('password')) {
            $users->password = bcrypt($request->password);
        }
        $users->rw_id       = $request->rw_id;
        $users->role_id     = $request->role_id;
        // Simpan perubahan
        $users->save();
        return redirect("user-management");
    }
    public function process_delete_users($id)
    {
        User::where('id', $id)->delete();
        return redirect('/user-management');
    }
}
