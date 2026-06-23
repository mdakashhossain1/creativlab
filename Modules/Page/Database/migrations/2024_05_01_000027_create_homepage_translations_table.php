<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::create('homepage_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('homepage_id');
            $table->string('lang_code');
            $table->string('intro_title')->nullable();
            $table->string('total_customer')->nullable();
            $table->string('total_rating')->nullable();
            $table->string('explore_short_title')->nullable();
            $table->text('explore_title')->nullable();
            $table->text('explore_description')->nullable();
            $table->string('working_step_title1')->nullable();
            $table->string('working_step_title2')->nullable();
            $table->string('working_step_title3')->nullable();
            $table->string('working_step_title4')->nullable();
            $table->string('working_step_des1')->nullable();
            $table->string('working_step_des2')->nullable();
            $table->string('working_step_des3')->nullable();
            $table->string('working_step_des4')->nullable();
            $table->text('join_seller_title')->nullable();
            $table->text('join_seller_des')->nullable();
            $table->string('mobile_app_title')->nullable();
            $table->text('mobile_app_des')->nullable();
            $table->string('feature_title1')->nullable();
            $table->string('feature_title2')->nullable();
            $table->string('feature_title3')->nullable();
            $table->string('feature_title4')->nullable();
            $table->string('feature_title5')->nullable();
            $table->text('home2_intro_title')->nullable();
            $table->text('home2_intro_description')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('homepage_translations'); }
};
