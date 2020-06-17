<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid("id")->index()->unique();
            $table->string("login_id")->unique();
            $table->string("password");
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("email")->unique();
            $table->tinyInteger("gender")->default(0);
            $table->string("address")->nullable();
            $table->date("birthday")->nullable();
            $table->string("code")->unique();
            $table->uuid("company_id"); //ref to companies table
            $table->uuid("avatar")->nullable();     //ref to files table
            $table->string("position");
            $table->date("start_at");
            $table->date("end_at")->nullable();
            $table->string("created_by")->nullable();
            $table->string("updated_by")->nullable();
            $table->string("deleted_by")->nullable();
            $table->timestamps(); //created_at and updated_at
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
        Schema::dropIfExists('users');
    }
}
