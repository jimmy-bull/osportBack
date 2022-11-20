<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_media', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('siteid');
            $table->varbinary('type', 64);
            $table->string('langid', 5)->nullable();
            $table->string('domain', 32);
            $table->string('label');
            $table->string('link');
            $table->text('preview');
            $table->string('mimetype', 64);
            $table->smallInteger('status');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->index(['siteid', 'domain', 'langid'], 'idx_msmed_sid_dom_langid');
            $table->index(['siteid', 'domain', 'label'], 'idx_msmed_sid_dom_label');
            $table->index(['siteid', 'domain', 'mimetype'], 'idx_msmed_sid_dom_mime');
            $table->index(['siteid', 'domain', 'link'], 'idx_msmed_sid_dom_link');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_media');
    }
}
