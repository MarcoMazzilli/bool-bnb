<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sponsorship;

class sponsorships_table_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $new_sponsorship_a = new Sponsorship();
        $new_sponsorship_a->name = 'One Day';
        $new_sponsorship_a->price = 2.99;
        $new_sponsorship_a->duration = 24;
        $new_sponsorship_a->description = 'Metti in cima per un giorno';
        $new_sponsorship_a->save();

        $new_sponsorship_b = new Sponsorship();
        $new_sponsorship_b->name = 'Three Days';
        $new_sponsorship_b->price = 5.99;
        $new_sponsorship_b->duration = 72;
        $new_sponsorship_b->description = 'Metti in cima per tre giorni';
        $new_sponsorship_b->save();

        $new_sponsorship_c = new Sponsorship();
        $new_sponsorship_c->name = 'Six Days';
        $new_sponsorship_c->price = 9.99;
        $new_sponsorship_c->duration = 144;
        $new_sponsorship_c->description = 'Metti in cima per sei giorni';
        $new_sponsorship_c->save();

        // dump($new_sponsorship_a,$new_sponsorship_b,$new_sponsorship_c);

    }
}
