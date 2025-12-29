<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminCommandController extends Controller
{ // Tableau de bord
    public function homes()
    {

        return view('admin.dashboard', []);
    }
    public function allProducts()
    {

        return view('admin.pages.allProducts', []);
    }
}
