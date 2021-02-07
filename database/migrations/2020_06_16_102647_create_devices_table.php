<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("code")->unique();
            $table->string("name");
            $table->double("price")->nullable();
            $table->uuid("company_id");
            $table->foreign("company_id")->references("id")->on("companies");
            $table->uuid("image")->nullable();
            $table->foreign("image")->references("id")->on("files");
            $table->string("created_by")->nullable();
            $table->string("updated_by")->nullable();
            $table->string("deleted_by")->nullable();
            $table->unsignedBigInteger("created_at")->nullable();
            $table->unsignedBigInteger("updated_at")->nullable();
            $table->unsignedBigInteger("deleted_at")->nullable(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
