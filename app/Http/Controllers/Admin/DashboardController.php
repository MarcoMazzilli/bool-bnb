<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Visit;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Paginate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index(){

    $apartmentsCount = [
        'appartamenti' => Apartment::all()->where('user_id', Auth::id())->count(),
        'appartamenti visibili' => Apartment::where('visible', 1)->where('user_id', Auth::id())->count(),
        'appartamenti nascosti' => Apartment::where('visible', 0)->where('user_id', Auth::id())->count()
    ];

    return view('admin.home', compact('apartmentsCount'));
}
}
