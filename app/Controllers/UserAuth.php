<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserAuth extends BaseController
{
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Username tidak ditemukan.');
        }

        if (!password_verify($password, $user->password)) {
            return redirect()->back()->with('error', 'Password salah.');
        }

        session()->set([
            'login' => true,
            'id_user' => $user->id_user,
            'nama_user' => $user->nama_user,
            'role' => $user->role
        ]);

        if ($user->role === 'admin') {
            return redirect()->to('/dashboard');
        }

        if ($user->role === 'kasir') {
            return redirect()->to('/kasir/dashboard');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
