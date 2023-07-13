<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
//Per lo slug
use Illuminate\Support\Str;
use PhpParser\Node\Expr\New_;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = ['Piscina','Parcheggio gratuito nella proprietà','Cucina','Wi-Fi','Lavatrice','Aria condizionata','Rilevatore di monossido di carbonio','Animali domestici ammessi','Asciugatrice','Telecamere di sicurezza presenti nella proprietà
      ','Riscaldamento','Griglia per barbecue','TV','Sauna','Lavastoviglie','Palestra','Spazio di lavoro dedicato
      '];

      foreach($data as $service){
        $new_service = new Service();
        $new_service->name = $service;
        $new_service->save();
      }
    }
}
