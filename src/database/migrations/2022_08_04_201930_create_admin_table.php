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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('login');
            $table->string('password');
            $table->rememberToken();
        });

        $pass = '$2y$10$GiRHNufj4MLh5BsWAxvgOe95mqai/t4sXyh3/rU74D4k0RapogG4W';

        DB::statement("INSERT INTO `admin` (`login`, `password`) VALUES ('admin', '{$pass}')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
};
