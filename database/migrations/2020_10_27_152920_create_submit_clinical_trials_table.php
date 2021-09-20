<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmitClinicalTrialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_clinical_trials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('trial')->nullable();
            $table->string('nct_number')->nullable();
            // $table->foreign('trial')->references('id')->on('saved_trials');
            $table->bigInteger('principal_inv')->unsigned();
            $table->foreign('principal_inv')->references('id')->on('users');
            $table->string('nct_no')->nullable();
            $table->string('research_site_name')->nullable();
            $table->string('no_of_visit')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('purpose_of_the_study')->nullable();
            $table->date('expiry_date')->nullable();
            $table->longText('summary')->nullable();
            $table->boolean('drug_involved')->nullable();
            $table->longText('list_of_participation')->nullable();
            $table->longText('lang_of_trial')->nullable();
            $table->string('upload_files')->nullable();

            $table->longText('synopsis')->nullable();
            $table->string('synopsis_upload_files')->nullable();
            $table->longText('objective')->nullable();
            $table->longText('design')->nullable();
            $table->longText('complete_inclusion_criteria')->nullable();
            $table->longText('complete_exclusion_criteria')->nullable();
            $table->longText('citations')->nullable();
            $table->longText('additional_information')->nullable();
            $table->longText('additional_doc_file')->nullable();
            $table->longText('additional_doc_name')->nullable();
            $table->enum('status',['1','2','3','4'])->default('1')->comment('Active, Deactive, Pending, Decline');
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('submit_clinical_trials');
    }
}
