<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("login_id")->unique();
            $table->string("password");
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("email")->unique();
            $table->tinyInteger("gender")->default(0);
            $table->string("address")->nullable();
            $table->date("birthday")->nullable();
            $table->uuid("avatar")->nullable();     //ref to files table
            $table->string("created_by")->nullable();
            $table->string("updated_by")->nullable();
            $table->string("deleted_by")->nullable();
            $table->unsignedBigInteger("created_at")->nullable();
            $table->unsignedBigInteger("updated_at")->nullable();
            $table->softDeletes(); // deleted_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
