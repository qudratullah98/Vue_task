<?php

use App\Models\country;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('user_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone');
            $table->date('date_of_birth');
            $table->enum('gander',['Male','female'])->default('Male');
            $table->enum('healt_status',['Normal','Abnormal'])->default('Normal');
            $table->string('nid')->unique();
            $table->string('image');
            $table->string('nationality');
            $table->string('religious');
            $table->string('whatsapp');
            $table->rememberToken();
            $table->timestamps();
            $table->foreignIdFor(country::class);
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
};
