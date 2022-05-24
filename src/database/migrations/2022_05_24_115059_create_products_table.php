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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug')->index();
            $table->string('short_desc' , 524);
            $table->string('thumbnail_url');

            $table->text('description');
            $table->text('gallery_url');
            $table->integer('count');
            $table->decimal('price' , 8 ,2);

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('cat_id')
                ->constrained('categories')
                ->cascadeOnUpdate();

            $table->foreignId('brand_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->foreignId('wish_id')
                ->constrained('wishlists' , 'id')
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
        Schema::dropIfExists('products');
    }
};
