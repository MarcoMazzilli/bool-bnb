<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apartments', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_image');
            $table->string('address');
            $table->string('address_info')->nullable();
            $table->point('coordinate');
            $table->decimal('price', 6 ,2)->nullable();
            $table->tinyInteger('n_of_bed');
            $table->tinyInteger('n_of_room');
            $table->tinyInteger('n_of_bathroom');
            $table->integer('apartment_size');
            $table->boolean('visible')->default(1);
            $table->string('type');
            $table->timestamps();

            // Foreign key User
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};
