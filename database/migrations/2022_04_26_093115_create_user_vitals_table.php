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
        Schema::create('user_vitals', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);

            $table->unsignedTinyInteger('weight')->default(0);
            $table->unsignedTinyInteger('blood_pressure_systolic')->default(0);
            $table->unsignedTinyInteger('blood_pressure_diastolic')->default(0);
            $table->unsignedTinyInteger('temperature')->default(0);
            $table->unsignedTinyInteger('fluid_intake')->default(0);
            $table->unsignedTinyInteger('drug_intake')->default(0);

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
        Schema::dropIfExists('user_vitals');
    }
};
