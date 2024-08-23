<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\ProductEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(ProductEnum::DB_TABLE, function (Blueprint $table) {
            $table->id(ProductEnum::ID)->autoIncrement();
            $table->unsignedBigInteger(ProductEnum::CATEGORY_ID);
            $table->string(ProductEnum::PRODUCT_NAME);
            $table->string(ProductEnum::PRODUCT_SKU)->unique();
            $table->decimal(ProductEnum::PRODUCT_PRICE, 10, 2);
            $table->integer(ProductEnum::PRODUCT_QUANTITY)->default(10);
            $table->text(ProductEnum::PRODUCT_IMAGE)->nullable();
            $table->text(ProductEnum::PRODUCT_DESCRIPTION)->nullable();
            $table->tinyInteger(ProductEnum::PRODUCT_STATUS)->default(ProductEnum::STATUS_ACTIVE);
            $table->timestamps();
            $table->SoftDeletes();

            $table->foreign(ProductEnum::CATEGORY_ID)
                ->references('category_id')
                ->on('categories')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ProductEnum::DB_TABLE);
    }
};
