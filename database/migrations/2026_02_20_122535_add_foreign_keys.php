<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Safely drop a foreign key if it exists.
     */
    private function dropForeignIfExists(string $table, string $column): void
    {
        $fkName = $table . '_' . $column . '_foreign';
        $exists = \Illuminate\Support\Facades\DB::select(
            "SELECT COUNT(*) as cnt FROM information_schema.TABLE_CONSTRAINTS
             WHERE CONSTRAINT_SCHEMA = DATABASE()
               AND TABLE_NAME = ?
               AND CONSTRAINT_NAME = ?
               AND CONSTRAINT_TYPE = 'FOREIGN KEY'",
            [$table, $fkName]
        );

        if ($exists[0]->cnt > 0) {
            Schema::table($table, fn (Blueprint $t) => $t->dropForeign([$column]));
        }
    }

    public function up(): void
    {
        // 1. users.role_id → roles.id  (change cascade→set null, make nullable)
        $this->dropForeignIfExists('users', 'role_id');
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id')->nullable()->change();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
        });

        // 2. applications.user_id → users.id
        $this->dropForeignIfExists('applications', 'user_id');
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });

        // 3. applications.job_id → jobs.id
        $this->dropForeignIfExists('applications', 'job_id');
        Schema::table('applications', function (Blueprint $table) {
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
        });

        // 4. form_submissions.form_id → forms.id
        $this->dropForeignIfExists('form_submissions', 'form_id');
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->foreign('form_id')->references('id')->on('forms')->onDelete('cascade');
        });

        // 5. tickets.assigned_to → users.id
        $this->dropForeignIfExists('tickets', 'assigned_to');
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });

        // 6. media.uploaded_by → users.id
        $this->dropForeignIfExists('media', 'uploaded_by');
        Schema::table('media', function (Blueprint $table) {
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('set null');
        });

        // 7. menus.parent_id → menus.id (self-referential)
        $this->dropForeignIfExists('menus', 'parent_id');
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
