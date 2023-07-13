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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apartment_id')->nullable();
            $table->string('object');
            $table->text('text');
            $table->string('author_email');
            $table->boolean('message_read')->default(0);
            $table->string('author_first_name');
            $table->string('author_last_name');
            $table->timestamps();

            // Foreign key Apartment

            $table->foreign('apartment_id')
            ->references('id')
            ->on('apartments')
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
        Schema::dropIfExists('messages');
    }
};
