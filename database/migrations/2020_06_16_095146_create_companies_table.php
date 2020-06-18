<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->string("email")->unique();
            $table->string("url")->nullable();
            $table->uuid("logo")->nullable();
            $table->foreign("logo")->references("id")->on("files");
            $table->string("created_by")->nullable();
            $table->string("updated_by")->nullable();
            $table->string("deleted_by")->nullable();
            $table->unsignedBigInteger("created_at")->nullable();
            $table->unsignedBigInteger("updated_at")->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
