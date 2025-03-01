<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->enum('permission', [
                'create_posts',
                'edit_posts',
                'edit_any_post',
                'delete_posts',
                'delete_any_post',
                'publish_posts',
                'unpublish_posts',
                'view_users',
                'create_users',
                'edit_users',
                'delete_users',
                'assign_roles',
                'revoke_roles',
                'view_roles',
                'create_roles',
                'edit_roles',
                'delete_roles',
                'manage_permissions',
                'upload_media',
                'delete_media',
                'view_media',
                'manage_settings',
            ]);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
