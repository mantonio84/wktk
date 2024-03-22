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
		$rep=app('snappy.pdf.wrapper')
				->loadFile($tmp)
				->setOptions($this->extractOptionsFromRequest($request))
				->inline();		
		unlink($tmp);
		return $rep;
	}
	
	private function extractOptionsFromRequest(Request $request){
		return Arr::except($request->input(),[
			"file",
			"app_secret"
		]);
	}
}
