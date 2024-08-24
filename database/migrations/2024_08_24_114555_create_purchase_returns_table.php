<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\PurchaseReturnEnum;
use App\Enums\PurchaseEnum;
use App\Enums\ProductEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(PurchaseReturnEnum::DB_TABLE, function (Blueprint $table) {
            $table->id(PurchaseReturnEnum::ID)->autoIncrement();
            $table->unsignedBigInteger(PurchaseReturnEnum::PURCHASE_ID);
            $table->unsignedBigInteger(PurchaseReturnEnum::PRODUCT_ID);
            $table->date(PurchaseReturnEnum::RETURN_DATE);
            $table->integer(PurchaseReturnEnum::RETURN_QUANTITY);
            $table->decimal(PurchaseReturnEnum::RETURN_AMOUNT, 10, 2);
            $table->string(PurchaseReturnEnum::RETURN_REASON)->nullable();
            $table->string(PurchaseReturnEnum::PAYMENT_TYPE)->nullable();
            $table->string(PurchaseReturnEnum::PAYMENT_STATUS)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(PurchaseReturnEnum::PURCHASE_ID)
                ->references(PurchaseEnum::ID)
                ->on(PurchaseEnum::DB_TABLE)
                ->cascadeOnDelete();

            $table->foreign(PurchaseReturnEnum::PRODUCT_ID)
                ->references(ProductEnum::ID)
                ->on(ProductEnum::DB_TABLE)
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(PurchaseReturnEnum::DB_TABLE);
    }
};
