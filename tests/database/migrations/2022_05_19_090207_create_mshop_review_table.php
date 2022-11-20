<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMshopReviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mshop_review', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('siteid');
            $table->string('domain', 32);
            $table->string('refid', 36);
            $table->string('customerid', 36);
            $table->string('ordprodid', 36);
            $table->string('name', 32);
            $table->smallInteger('status');
            $table->smallInteger('rating');
            $table->text('comment');
            $table->text('response');
            $table->dateTime('mtime');
            $table->dateTime('ctime');
            $table->string('editor');
            
            $table->unique(['siteid', 'customerid', 'domain', 'refid'], 'unq_msrev_sid_cid_dom_rid');
            $table->index(['siteid', 'domain', 'refid', 'status', 'ctime'], 'idx_msrev_sid_dom_rid_sta_ct');
            $table->index(['siteid', 'domain', 'refid', 'status', 'rating'], 'idx_msrev_sid_dom_rid_sta_rate');
            $table->index(['siteid', 'domain', 'customerid', 'mtime'], 'idx_msrev_sid_dom_cid_mt');
            $table->index(['siteid', 'rating', 'domain'], 'idx_msrev_sid_rate_dom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mshop_review');
    }
}
