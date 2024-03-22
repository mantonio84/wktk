<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HtmlToPdfController extends Controller
{
    public function convert(Request $request){
		$request->validate([
			"file" => ["required","file","mimes:html"]
		]);
		return app('snappy.pdf.wrapper')
				->loadFile($request->file("file")->path())
				->setOptions(Arr::except($request->all(),"file"))				
				->inline();		
	}
}
