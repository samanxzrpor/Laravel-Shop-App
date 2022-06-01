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
        Schema::create('product_metas', function (Blueprint $table) {
            $table->id();

            $table->float('width' , 8 ,2)
                ->nullable();
            $table->float('height' ,8 ,2)
                ->nullable();
            $table->float('weight' , 8 ,2)
                ->nullable();
            $table->integer('receive_duration')
                ->nullable();

            $table->enum('quality' , ['YES' , 'NO'])
                ->nullable()
                ->default('YES');

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_metas');
    }
};
