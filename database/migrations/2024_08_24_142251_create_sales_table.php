<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SalesEnum;
use App\Enums\ProductEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(SalesEnum::DB_TABLE, function (Blueprint $table) {
            $table->id(SalesEnum::ID)->autoIncrement();
            $table->unsignedBigInteger(SalesEnum::PRODUCT_ID);
            $table->unsignedBigInteger(SalesEnum::CUSTOMER_ID);
            $table->integer(SalesEnum::SALES_QUANTITY);
            $table->decimal(SalesEnum::SALES_PRICE, 10, 2)->nullable();
            $table->date(SalesEnum::SALES_DATE);
            $table->decimal(SalesEnum::SALES_TOTAL, 10, 2);
            $table->string(SalesEnum::PAYMENT_TYPE)->nullable();
            $table->string(SalesEnum::PAYMENT_STATUS)->nullable();
            $table->tinyInteger(SalesEnum::IS_RETURNED)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(SalesEnum::PRODUCT_ID)
                ->references(ProductEnum::ID)
                ->on(ProductEnum::DB_TABLE)
                ->cascadeOnDelete();
            $table->foreign(SalesEnum::CUSTOMER_ID)
                ->references('customer_id')
                ->on('customers')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(SalesEnum::DB_TABLE);
    }
};
