<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\UserEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(UserEnum::DB_TABLE, function (Blueprint $table) {
            $table->id();
            $table->string(UserEnum::NAME);
            $table->string(UserEnum::EMAIL)->unique();
            $table->string(UserEnum::PHONE)->unique();
            $table->string(UserEnum::PASSWORD);
            $table->tinyInteger(UserEnum::STATUS)->default(UserEnum::STATUS_ACTIVE);
            $table->string(UserEnum::ROLE)->default(UserEnum::ROLE_USER);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(UserEnum::DB_TABLE);
    }
};
