<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
{
    
    public function login()
    {
        helper(['form']);
        return view('Admin/login');
    }

    public function prosesLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username === 'admin' && $password === 'admin') {
            session()->set([
                'id'      => 1,
                'level'   => 'admin',
                'isLogin' => true,
            ]);

            return redirect()->to(base_url('admin/dashboard'));
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function dashboard()
    {
        if (!session()->get('isLogin')) {
            return redirect()->to(base_url('admin/login'));
        }

        helper('url');
        return view('Admin/dashboard');
    }

    public function index()
    {
        return redirect()->to(base_url('admin/dashboard'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}
