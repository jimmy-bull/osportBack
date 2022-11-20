<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPropertyTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_property_type', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->string('domain', 32);
            $table->varbinary('code', 64);
            $table->string('label');
            $table->integer('pos')->default(0);
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'domain', 'code'], 'unq_lvuprty_sid_dom_code');
            $table->index(['siteid', 'status', 'pos'], 'idx_lvuprty_sid_status_pos');
            $table->index(['siteid', 'label'], 'idx_lvuprty_sid_label');
            $table->index(['siteid', 'code'], 'idx_lvuprty_sid_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_property_type');
    }
}
