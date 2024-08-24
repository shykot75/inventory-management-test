<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PurchaseEnum;
use App\Enums\ProductEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(PurchaseEnum::DB_TABLE, function (Blueprint $table) {
            $table->id(PurchaseEnum::ID)->autoIncrement();
            $table->unsignedBigInteger(PurchaseEnum::PRODUCT_ID);
            $table->unsignedBigInteger(PurchaseEnum::SUPPLIER_ID);
            $table->integer(PurchaseEnum::PURCHASE_QUANTITY);
            $table->decimal(PurchaseEnum::PURCHASE_PRICE, 10, 2)->nullable();
            $table->date(PurchaseEnum::PURCHASE_DATE);
            $table->decimal(PurchaseEnum::PURCHASE_TOTAL, 10, 2);
            $table->string(PurchaseEnum::PAYMENT_TYPE)->nullable();
            $table->string(PurchaseEnum::PAYMENT_STATUS)->nullable();
            $table->tinyInteger(PurchaseEnum::IS_RETURNED)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(PurchaseEnum::PRODUCT_ID)
                ->references(ProductEnum::ID)
                ->on(ProductEnum::DB_TABLE)
                ->cascadeOnDelete();
            $table->foreign(PurchaseEnum::SUPPLIER_ID)
                ->references('supplier_id')
                ->on('suppliers')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(PurchaseEnum::DB_TABLE);
    }
};
