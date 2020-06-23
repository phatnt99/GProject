<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("name");
            $table->string("upload_name");
            $table->string("mime_type")->nullable();
            $table->string("model_type")->nullable();
            $table->boolean("is_public")->default(true);
            $table->bigInteger("size")->default(0);
            $table->string("disk");
            $table->string("path");
            $table->longText("additional")->nullable();
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
        Schema::dropIfExists('files');
    }
}
