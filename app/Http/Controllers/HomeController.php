<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('frontoffice.home');
    }
    public function profil(){
        return view('frontoffice.profil');
    }
    public function informasi(){
        return view('frontoffice.informasi');
    }
    public function hubungi(){
        return view('frontoffice.hubungi');
    }
    public function detail(){
        return view('frontoffice.detail');
    }
}
