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
        Schema::create('zaoob_tokens', function (Blueprint $table) {
            $table->id();
            $table->nullableUuidMorphs('modelable');
            $table->string('name');
            $table->string('token');
            $table->date('last_use')->nullable();
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
        Schema::dropIfExists('zaoom_tokans');
    }
};
