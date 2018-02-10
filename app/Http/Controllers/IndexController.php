<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    public function Index()
    {
        return view('index');
    }

    public function Login()
    {
        $title = 'Login';
        return view('user.login');
    }

    public function SignUp()
    {
        if ($_POST['name'])
        {
            echo $_POST['name'];
        }
    }
}