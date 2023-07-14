<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Service;
use App\Models\Visit;
use App\Models\Image;
use App\Models\Message;
use App\Models\User;
use App\Models\Sponsorship;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Paginate;
use Illuminate\Http\Request;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Support\Str;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('user_id', Auth::id())->orderBy('updated_at', 'desc')->get();
        // dd($apartments);
        // $sponsoredApartments = ;

        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $method = 'POST';
        return view('admin.apartments.create', compact('method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartmentRequest $request)
    {
        $form_data = $request->all();

        $new_apartment = new Apartment();

        $form_data['coordinate'] = DB::raw($new_apartment->getCoordinates($form_data['address']));


        $new_apartment->user_id =  Auth::id();


        if(array_key_exists('cover_image', $form_data)){
            $form_data['cover_image'] = Storage::put('uploads', $form_data['cover_image']);

        }else{
            @dump(' non esiste');
        }
        // @dd('');
        $new_apartment->fill($form_data);
        // dd($new_apartment);
        $new_apartment->save();
        return redirect()->route('admin.apartments.show', $new_apartment);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $method = 'PUT';
        $route = route('admin.apartments.update', $apartment);
        return view('admin.apartments.edit', compact('apartment', 'method', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApartmentRequest $request, Apartment $apartment)
    {
        $form_data = $request->all();
        // // se il name è stato modificato genero un nuovo slug
        // if($apartment->name !== $form_data['name']){
        //   $form_data['slug']  = Apartment::generateSlug($form_data['name']);
        // }else{
        // // altrimenti salvo lo slug
        //   $form_data['slug']  = $apartment->slug;
        // }

        if (array_key_exists('cover_image', $form_data)) {

            // se l'immagine esiste vuol dire che ne ho caricata una nuova e quindi elimino quella vecchia
            if ($apartment->cover_image) {
                Storage::disk('public')->delete($apartment->cover_image);
            }
            // salvo l'immagine nella cartella uploads e in $form_data['cover_image'] salvo il percorso
            $form_data['cover_image'] = Storage::put('uploads/', $form_data['cover_image']);
        }

        $apartment->update($form_data);

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
