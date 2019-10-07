<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function upload(Request $request){
        if ($request->file('file_data')->isValid()) {
            $file = $request->file('file_data');
        }
    }
}
