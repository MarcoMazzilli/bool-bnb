<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Apartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // Relazione con l'user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Relazione con le immagini
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    // Relazione con le visite
    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
    // Relazione con i messaggi
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    //Relazione pivot con sponsorship
    public function sponsorships()
    {
        return $this->belongsToMany(Sponsorship::class);
    }
    //Relazione pivot con servizi
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    protected $fillable = [
        'name',
        'slug',
        'user_id',
        'description',
        'cover_image',
        'address',
        'address_info',
        'coordinate',
        'price',
        'n_of_bed',
        'n_of_room',
        'n_of_bathroom',
        'apartment_size',
        'visible',
        'type'
    ];

    public static function getCoordinates($address)
    {
        //Url di base
        $baseUrl = 'https://api.tomtom.com/';
        // Geocodin API (tipo di dato che voglio ricevere)
        $geocodigSearch = 'search/2/geocode/';
        // Indirizzo da cercare
        $addressToSearch = Str::slug($address, '-');
        // Parametri della query
        $queryType  = '.json?typeahead=false&limit=1&view=Unified&key=';
        // Key personale per fare le chiamate
        $apiKey = env("API_TT_KEY");


        $info_address_json = file_get_contents($baseUrl . $geocodigSearch . $addressToSearch . $queryType . $apiKey);
        $info_address = json_decode($info_address_json, JSON_PRETTY_PRINT);

        $lat = $info_address['results'][0]['position']['lat'];
        $lon = $info_address['results'][0]['position']['lon'];

        $datatype = "ST_GeomFromText('POINT(  $lon  $lat  )')";

        return $datatype;
    }
}
