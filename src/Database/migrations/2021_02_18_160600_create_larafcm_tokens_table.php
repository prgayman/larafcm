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
            $table->string("entity_type")->nullable();
            $table->unsignedBigInteger("entity_id")->nullable();
            $table->string("locale")->nullable();
            
            $table->timestamps();
            $table->index(["entity_type", "entity_id"]);
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
