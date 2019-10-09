<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function upload(Request $request){
        if ($request->hasFile('file_data')&&$request->file('file_data')->isValid()) {
            $module = $request->input('module');
            $dir = $request->input('dir')??'images';
            $path = 'uploads/'.$module.'/'.$dir.'/'.date('Ym/d');

            $file = $request->file('file_data');
            $ext = $file->extension();
            $originalName = $file->getClientOriginalName();
            $filename = sha1($originalName.time().rand(1000, 9999)).'.'.$ext;

            $file->move($path,$filename);

            $res['status'] = true;
            $res['code'] = 200;
            $res['msg'] = '文件上传成功';
            $res['url'] = url($path.'/'.$filename);
            $res['file_path'] = $path.'/'.$filename;
            $res['filename'] = $originalName;
            return json_encode($res);
        }else{
            $res['status'] = false;
            $res['code'] = 500;
            $res['msg'] = '文件上传失败';
            $res['url'] = '';
            $res['file_path'] = '';
            $res['filename'] = '';
            return json_encode($res);
        }
    }
}
