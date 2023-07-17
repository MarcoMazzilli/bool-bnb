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

    public static function saveImage($request, $form_data, $model){

        // estensione dell' immagine
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Se esiste una description dell'immagine utilizzo quella per compilare il nome, altrimenti assegno un nome generico e randomico.
        if(array_key_exists('image_description', $form_data)){
            $file_name = Str::slug($form_data['image_description'], '-') . '.' . $extension;
        }else{
            $file_name = 'img' . rand(1000,10000) . '.' . $extension;
        }

        // percorso in cui salvare l'immagine
        $path = 'uploads/' . Str::slug($form_data['name'], '-');

        if($model::where('cover_image', $path . '/' .$file_name )->first()){
            $file_name = Str::slug($form_data['name'], '-') . '-' .rand(1000,10000) . '.' . $extension;
        }

        return Storage::putFileAs($path, $form_data['cover_image'], $file_name);
    }
}
