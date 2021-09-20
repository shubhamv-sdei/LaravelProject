<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->bigIncrements('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('role')->index('role');
            $table->string('image')->nullable();
            $table->string('contact')->nullable();
            $table->longText('address')->nullable();
            $table->string('sex')->nullable();
            $table->date('dob')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('verified')->default(false);
            $table->boolean('subscribed')->default(false);
            $table->integer('parent_id')->nullable();
            $table->integer('associated_with')->nullable();
            $table->string('stripe_customer_id')->nullable();
            $table->longText('stripe_customer_json')->nullable();
            $table->string('stripe_bnk_account_id')->nullable();
            $table->longText('stripe_bnk_account_json')->nullable();
            $table->rememberToken();
            $table->enum('is_deleted',['1','2'])->default('1')->comment('Active, Deleted');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->foreign('role')->references('id')->on('roles')->onDelete('CASCADE')->onUpdate('CASCADE');
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
