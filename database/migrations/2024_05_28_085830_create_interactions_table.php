<?php

declare(strict_types=1);

use App\Enums\Interactions\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('interactions', static function (Blueprint $table): void {
            $table->ulid('id')->primary();

            $table->string('type')->default(Type::Other->value);

            $table->text('summary')->nullable();
            $table->text('next')->nullable();

            $table
                ->foreignUlid('contact_id')
                ->index()
                ->constrained('contacts')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
