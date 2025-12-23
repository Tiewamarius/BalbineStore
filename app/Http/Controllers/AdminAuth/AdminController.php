<?php

namespace App\Http\Controllers\AdminAuth;

use App\Http\Controllers\Controller;
use App\Models\Residence;
use App\Models\Booking;
use App\Models\User;
use App\Models\Admin;

use Illuminate\Http\Request;

class AdminController extends Controller
{ // Tableau de bord
    public function homes()
    {

        return view('admin.dashboard', []);
    }
}
