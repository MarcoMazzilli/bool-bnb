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
        //nome immagine
        $image_name = preg_replace('/\..+$/', '', $request->file('cover_image')->getClientOriginalName());
        // estensione immagine
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        // nome che voglio assegnare
        // TODO: se nel form data arriva un titolo descrittivo il nome dell'immagine corrispondera a quello, cosi da poterlo inserire anche nell'alt dell'immagine per questioni di accessibilità
        $file_name = Str::slug($form_data['name'], '-') . '.' . $extension;

        // percorso in cui salvare l'immagine
        $path = 'uploads/' . Str::slug($form_data['name'], '-');

        if($model::where('cover_image', $path . '/' .$file_name )->first()){
            $file_name = Str::slug($form_data['name'], '-') . '-' .rand(1000,10000) . '.' . $extension;
        }

        return Storage::putFileAs($path, $form_data['cover_image'], $file_name);
    }
}
