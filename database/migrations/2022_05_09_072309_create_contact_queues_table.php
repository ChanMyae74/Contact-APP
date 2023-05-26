<?php

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
        Schema::create('contact_queues', function (Blueprint $table) {
            $table->id();
            $table->json("contact_ids");
            $table->foreignId("sender_id")->constrained("users")->cascadeOnDelete();
            $table->foreignId("receiver_id")->constrained("users")->cascadeOnDelete();
            // $table->enum("action", [0, 1])->nullable(); // 0 copy 1 cut
            $table->text("message")->nullable();
            $table->string("status")->nullable(); // 0 is pending , 1 is accept , if denied delete record
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
        Schema::dropIfExists('contact_queues');
    }
};
