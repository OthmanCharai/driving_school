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
        Schema::create('dropzons', function (Blueprint $table) {
            $table->id();
            $table->text('x_position');
            $table->text('y_position');
            $table->foreignId('question_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('option_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('dropzons',function (Blueprint $table){
            $table->dropForeign('dropzons_question_id_foreign');
            $table->dropForeign('dropzons_option_id_foreign');
        });
        Schema::dropIfExists('dropzons');
    }
};
