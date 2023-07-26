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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Paginate;
use Illuminate\Http\Request;
use App\Http\Requests\ApartmentRequest;
use Illuminate\Support\Str;
use App\Helpers\CustomHelper;
use Spatie\LaravelIgnition\Recorders\DumpRecorder\Dump;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function visible(ApartmentRequest $request,Apartment $apartment){
    //     $data = [];

    //     if($apartment->visible === 1){
    //         $data['visible'] = 0;
    //     }elseif($apartment->visible === 0){
    //         $data['visible'] = 1;
    //     }
    //     // dd($apartment);
    //     $method = 'PUT';
    //     // $route = route('admin.apartments.update', $apartment);
    //     $apartment->visible->update(0);
    //     return view('admin.apartments.index', compact('apartment'));

    //  }

    public function index()
    {
        $apartmentsVisible = Apartment::where('user_id', Auth::id())
        ->where('visible', 1)
        ->orderBy('updated_at', 'desc')->get();

        $apartmentsHidden= Apartment::where('user_id', Auth::id())
        ->where('visible', 0)
        ->orderBy('updated_at', 'desc')->get();

        $apartmentSponsored = Apartment::where('user_id', Auth::id())
        ->with('services', 'sponsorships')
        ->whereHas('sponsorships', function (Builder $query) {
          $query->where('sponsorship_id', '!=', 1);
        })->get();

        $num_sponsorship = 0;
        foreach($apartmentsVisible as $apartment ){
            $num_sponsorship += $apartment->sponsorships->count();
        }


        return view('admin.apartments.index', compact('apartmentsVisible','apartmentsHidden','apartmentSponsored', 'num_sponsorship'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        $method = 'POST';
        return view('admin.apartments.create', compact('method','services'));
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
            $form_data['cover_image'] = CustomHelper::saveImage($request, $form_data , new Apartment());
        }
        else{
          $form_data['cover_image'] = 'seeder-img/placeholder.jpg';
        }


        $new_apartment->fill($form_data);


        $new_apartment->save();

        if (array_key_exists('services', $form_data)) {
            $new_apartment->services()->attach($form_data['services']);
        }

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
      $apartment = Apartment::select([
        'id','user_id','name','slug','description','slug','cover_image','address','address_info','price','n_of_bed','n_of_room','n_of_bathroom','apartment_size','type','created_at',
      DB::raw("ST_X(coordinate) as latitude"),
      DB::raw("ST_Y(coordinate) as longitude")])->where('id', $apartment->id)
    ->first();

    $lat = $apartment->latitude;
    $lon = $apartment->longitude;

        return view('admin.apartments.show', compact('apartment','lat','lon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
        $method = 'PUT';
        $route = route('admin.apartments.update', $apartment);
        return view('admin.apartments.edit', compact('apartment', 'method', 'route','services'));
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

        if (array_key_exists('services', $form_data)) {
            $apartment->services()->sync($form_data['services']);
        }else{
            $apartment->services()->detach();
        }
        // @dd($form_data);

        $apartment->update($form_data);

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Apartment $apartment)
    {
        if($apartment->cover_image){
            Storage::disk('public')->delete($apartment->cover_image);
        }

        // dd($apartment);
        $apartment->services()->detach();

        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('deleted','appartamento eliminato');
    }
}
