<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $model = new AdminModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $admin = $model->where('username', $username)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Username salah!');
        }

        if (!password_verify($password, $admin->password)) {
            return redirect()->back()->with('error', 'Password salah!');
        }

        session()->set([
            'admin_login' => true,
            'admin_id'    => $admin->id_admin,
            'admin_name'  => $admin->nama_admin
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
