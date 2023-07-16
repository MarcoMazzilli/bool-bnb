<?php

namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CustomHelper{

    public static function generateUniqueSlug($str, $model){

        $slug = Str::slug($str, '-');
        $original_slug = $slug;
        $slug_exixts = $model::where('slug', $slug)->first();
        $c = 1;
        while($slug_exixts){
            $slug = $original_slug . '-' . $c;
            $slug_exixts = $model::where('slug', $slug)->first();
            $c++;
        }
        return $slug;
    }

    public static function saveImage($image, $request, $form_data, $model){

        $original_name = $request->file($image)->getClientOriginalName();
        $nameonly = preg_replace('/\..+$/', '', $request->file($image)->getClientOriginalName());
        $ext = $request->file($image)->getClientOriginalExtension();
        $file_name = Str::slug($nameonly, '-') . '.' . $ext;
        $path = 'uploads/' . date('Y') . '/' . date('m');

        if($model::where($image, $path . '/' .$file_name )->first()){
            $nameonly .= '-' . rand(1000,10000);
            $file_name = Str::slug($nameonly, '-') . '.' . $ext;
        }

        $form_data[$image] = Storage::putFileAs($path, $form_data[$image], $file_name);

        return $form_data;
    }
}
