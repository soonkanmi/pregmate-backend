<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_obstetrical_information', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);
            $table->unsignedBigInteger('previous_pregnancies')->default(0);
            $table->unsignedBigInteger('liveborns')->default(0);
            $table->unsignedBigInteger('stillbirths')->default(0);
            $table->string('previous_mode_of_delivery', 20);

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
        Schema::dropIfExists('user_obstetrical_information');
    }
};
