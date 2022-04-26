<?php

use App\Models\User;
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
        Schema::create('user_medical_information', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);

            $table->string('bloodgroup', 5);
            $table->string('allergies')->nullable();
            $table->string('rhesus_factor');

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
        Schema::dropIfExists('user_medical_information');
    }
};
