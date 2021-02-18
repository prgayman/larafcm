<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLarafcmTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('larafcm_tokens', function (Blueprint $table) {
            $table->id();
            $table->string("token");
            $table->string("platform")->nullable();
            $table->string("model_type")->nullable();
            $table->unsignedBigInteger("model_id")->nullable();
            $table->string("locale")->nullable();
            
            $table->timestamps();
            $table->index(["model_type", "model_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('larafcm_tokens');
    }
}
