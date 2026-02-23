<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Make role_id nullable so SET NULL cascade works
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->change();
        });

        // 1. users.role_id → roles.id
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });

        // 2. applications.user_id → users.id
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // 3. applications.job_id → jobs.id
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });

        // 4. form_submissions.form_id → forms.id
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });

        // 5. tickets.assigned_to → users.id
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });

        // 6. media.uploaded_by → users.id
        Schema::table('media', function (Blueprint $table) {
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });

        // 7. menus.parent_id → menus.id (self-referential)
        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', fn (Blueprint $t) => $t->dropForeign(['role_id']));
        Schema::table('applications', fn (Blueprint $t) => $t->dropForeign(['user_id']));
        Schema::table('applications', fn (Blueprint $t) => $t->dropForeign(['job_id']));
        Schema::table('form_submissions', fn (Blueprint $t) => $t->dropForeign(['form_id']));
        Schema::table('tickets', fn (Blueprint $t) => $t->dropForeign(['assigned_to']));
        Schema::table('media', fn (Blueprint $t) => $t->dropForeign(['uploaded_by']));
        Schema::table('menus', fn (Blueprint $t) => $t->dropForeign(['parent_id']));
    }
};
