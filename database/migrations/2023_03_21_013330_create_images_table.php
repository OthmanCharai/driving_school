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
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->foreignId('question_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->boolean('status');
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
        Schema::table('images',function(Blueprint $table){
            $table->dropForeign('images_question_id_foreign');
        });
        Schema::dropIfExists('images');
    }
};
