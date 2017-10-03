<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('references.table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash')->index();
            $table->morphs('model');
            $table->timestamps();

            $table->unique(['hash', 'model_id', 'model_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('references.table_name'));
    }
}
