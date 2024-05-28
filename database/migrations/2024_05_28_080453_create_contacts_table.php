<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('contacts', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->json('name');
            $table->json('email')->nullable();
            $table->json('socials')->nullable();
            $table->string('role')->nullable();
            $table->string('pronouns')->nullable();

            $table
                ->foreignUlid('company_id')
                ->nullable()->index();

            $table
                ->foreignUlid('user_id')
                ->index()
                ->constrained('users')
                ->cascadeOnDelete();

            $table->date('birthday')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
