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
            $table->id();
            $table->string('name');
            $table->string('email')->unique('unq_lvusr_email');
            $table->date('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->smallInteger('superuser')->default(0);
            $table->string('siteid')->default('');
            $table->string('salutation', 8)->default('');
            $table->string('company', 100)->default('');
            $table->string('vatid', 32)->default('');
            $table->string('title', 64)->default('');
            $table->string('firstname', 64)->default('');
            $table->string('lastname', 64)->default('')->index('idx_lvusr_lastname');
            $table->string('address1', 200)->default('')->index('idx_lvusr_address1');
            $table->string('address2', 200)->default('');
            $table->string('address3', 200)->default('');
            $table->string('postal', 16)->default('');
            $table->string('city', 200)->default('')->index('idx_lvusr_city');
            $table->string('state', 200)->default('');
            $table->string('langid', 5)->nullable()->index('idx_lvusr_langid');
            $table->string('countryid', 2)->nullable();
            $table->string('telephone', 32)->default('');
            $table->string('telefax', 32)->default('');
            $table->string('website')->default('');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->date('birthday')->nullable();
            $table->smallInteger('status')->default(1);
            $table->string('editor')->default('');
            
            $table->index(['lastname', 'firstname'], 'idx_lvusr_last_first');
            $table->index(['postal', 'address1'], 'idx_lvusr_post_addr1');
            $table->index(['postal', 'city'], 'idx_lvusr_post_city');
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
