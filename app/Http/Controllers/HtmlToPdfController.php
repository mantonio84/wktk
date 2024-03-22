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
		$tmp=GetSysTempFilePath("html");
		copy($request->file("file")->getPathname(),$tmp);
		return app('snappy.pdf.wrapper')
				->loadFile($tmp)
				->setOptions(Arr::except($request->all(),"file"))				
				->inline();		
	}
}
