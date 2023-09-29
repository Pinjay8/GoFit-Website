<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware("CheckLogin");
    }

    public function index()
    {
        return view("dashboard/main")->with([
            "user" => Auth::guard("pegawai")->user(),
        ]);
    }
}
