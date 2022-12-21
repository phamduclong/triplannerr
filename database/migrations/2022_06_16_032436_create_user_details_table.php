<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id');
            $table->string('profile_image', 255)->nullable();
            $table->string('cover_image', 255)->nullable();
            $table->string('profile_badge', 255)->nullable();
            $table->string('term_condition', 255)->nullable();
            $table->text('describe_yourself')->nullable();
            $table->string('role_type', 255)->nullable();
            $table->string('phone_no', 255)->nullable();
            $table->dateTime('birth_place')->nullable();
            $table->string('sex', 255)->nullable()->default('male');
            $table->string('relation_status', 100)->nullable();
            $table->string('place_of_residence', 255)->nullable();
            $table->enum('preferred_type', ['Bed and breakfast', 'Half board', 'Full board'])->nullable()->default('Bed and breakfast');
            $table->string('front_identity_doc', 255)->nullable();
            $table->string('back_identity_doc', 255)->nullable();
            $table->string('pdf_doc', 255)->nullable();
            $table->string('sign_organize', 255)->nullable();
            $table->string('sign_tour_leader', 255)->nullable();
            $table->string('sign_agreement_recognize', 255)->nullable();
            $table->string('classification_travel_report', 255)->nullable();
            $table->string('identity_document', 255)->nullable();
            $table->string('telephone_number', 255)->nullable();
            $table->string('vat_number', 255)->nullable();
            $table->string('personal_website', 255)->nullable();
            $table->string('fb_link', 255)->nullable();
            $table->string('twitter_link', 255)->nullable();
            $table->string('insta_link', 255)->nullable();
            $table->string('pinterest_link', 255)->nullable();
            $table->string('tiktok_link', 255)->nullable();
            $table->string('youtube_link', 255)->nullable();
            $table->string('sentimental_situation', 255)->nullable();
            $table->string('preferred_travel_category', 255)->nullable();
            $table->string('type_of_travel', 255)->nullable();
            $table->string('type_of_accommodation', 255)->nullable();
            $table->string('vector_type', 255)->nullable();
            $table->string('type_of_participants', 255)->nullable();
            $table->string('preferred_travel_budget', 255)->nullable();
            $table->string('agency_name', 255)->nullable();
            $table->string('agency_website', 255)->nullable();
            $table->string('agency_address', 255)->nullable();
            $table->string('license_detail', 255)->nullable();
            $table->string('identification_option', 255)->nullable();
            $table->string('local_operator', 255)->nullable();
            $table->string('tourist_facility', 255)->nullable();
            $table->string('doc_agency_data', 255)->nullable();
            $table->string('doc_agency_doc', 255)->nullable();
            $table->string('doc_upload', 255)->nullable();
            $table->string('agency_logo', 255)->nullable();
            $table->string('signed_doc', 255)->nullable();
            $table->string('fav_nation', 255)->nullable();
            $table->text('fav_nation_want')->nullable();
            $table->text('blogger_service')->nullable();
            $table->string('travel_favoritemealtype', 255)->nullable();
            $table->integer('follow')->default(0);
            $table->text('other')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
