<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class HtmlToPdfController extends Controller
{
    public function convert(Request $request){
		$request->validate([
			"file" => ["required","file","mimes:html","min:1"]
		]);
		$tmp=GetSysTempFilePath("html");
		$a=@copy($request->file("file")->getPathname(),$tmp);
		if ($a===false){
			return response()->json(["message" => "temp file copy error."],500);
		}
		return app('snappy.pdf.wrapper')
				->loadFile($tmp)
				->setOptions($this->extractOptionsFromRequest($request))
				->stream();				
	}
	
	private function extractOptionsFromRequest(Request $request){
		return $request->input();
	}
}
