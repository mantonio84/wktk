<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function health(){
		return microtime(true);
	}
	
	public function home() {
		return "";
	}
}
