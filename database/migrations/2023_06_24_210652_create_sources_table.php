<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string("data_source");
            $table->string("source_id");
            $table->string("name");
            $table->string("url");
            $table->string("language");
            $table->string("country");
            $table->string('category');
            $table->text("description");
            $table->timestamps();

            $table->foreign("data_source")->references('slug')->on("data_sources")
                ->onDelete("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sources');
    }
};
