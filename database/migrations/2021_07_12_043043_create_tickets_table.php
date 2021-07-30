<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id')->references('id')->on('users');
            $table->unsignedBigInteger('source_id');
            $table->foreign('source_id')->references('id')->on('users');
            $table->unsignedBigInteger('departure');
            $table->foreign('departure')->references('id')->on('places');
            $table->unsignedBigInteger('destination');
            $table->foreign('destination')->references('id')->on('places');
            $table->date('ticket_issue_date')->nullable();
            $table->date('travel_date')->nullable();
            $table->smallInteger('quantity');
            $table->date('corona_test_date')->nullable();
            $table->set('corona_test_result', ['positive', 'negative', 'not tested']);
            $table->set('ticket_status', ['ongoing', 'reissue', 'refund']);
            $table->unsignedBigInteger('payment_type_id');
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->string('price', 10);
            $table->string('sell_price', 10);
            $table->set('payment_status', ['paid', 'due']);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('tickets');
    }
}
