<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * User
         */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamp("apprentice_start")->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        /**
         * Cache
         */
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        /**
         * Assignment
         */
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId("school_class_id");
            $table->foreignId("subject_id");
            $table->foreignId("assignment_type_id");
            $table->string("name");
            $table->float("weight");
            $table->timestamps();
        });

        Schema::create('assignment_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        /**
         * FinalGrade
         */
        Schema::create('final_grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("subject_id");
            $table->foreignId("final_grade_type_id");
            $table->float("grade");
            $table->timestamps();
        });

        Schema::create('final_grade_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        /**
         * Grade
         */
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("assignment_id");
            $table->float("grade");
            $table->timestamps();
        });

        /**
         * SchoolClass
         */
        Schema::create('school_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("school_class_type_id");
            $table->string("name");
            $table->timestamps();
        });

        Schema::create('school_class_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });

        /**
         * UserSchoolClass
         */
        Schema::create('user_school_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->foreignId("school_class_id");
            $table->timestamps();
        });

        /**
         * Subject
         */
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId("subject_type_id");
            $table->string("name");
            $table->timestamps();
        });

        Schema::create('subject_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->timestamps();
        });
    }

    public function down(): void {}
};
