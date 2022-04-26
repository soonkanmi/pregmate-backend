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
        Schema::create('user_pregnancy_infos', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class);

            $table->date('date_concieved');
            $table->date('first_trimester_ends');
            $table->date('second_trimester_ends');
            $table->date('estimated_due_date');

            $table->unsignedTinyInteger('delivery_status');
            $table->date('actual_delivery_date')->nullable();
            $table->string('mode_of_delivery')->nullable();
            $table->unsignedTinyInteger('is_liveborn')->nullable();

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
        Schema::dropIfExists('user_pregnancy_infos');
    }
};
