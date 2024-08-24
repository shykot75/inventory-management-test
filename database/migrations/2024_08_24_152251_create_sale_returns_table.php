<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SalesReturnEnum;
use App\Enums\SalesEnum;
use App\Enums\ProductEnum;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(SalesReturnEnum::DB_TABLE, function (Blueprint $table) {
            $table->id(SalesReturnEnum::ID)->autoIncrement();
            $table->unsignedBigInteger(SalesReturnEnum::SALE_ID);
            $table->unsignedBigInteger(SalesReturnEnum::PRODUCT_ID);
            $table->date(SalesReturnEnum::RETURN_DATE);
            $table->integer(SalesReturnEnum::RETURN_QUANTITY);
            $table->decimal(SalesReturnEnum::RETURN_AMOUNT, 10, 2);
            $table->string(SalesReturnEnum::RETURN_REASON)->nullable();
            $table->string(SalesReturnEnum::PAYMENT_TYPE)->nullable();
            $table->string(SalesReturnEnum::PAYMENT_STATUS)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign(SalesReturnEnum::SALE_ID)
                ->references(SalesEnum::ID)
                ->on(SalesEnum::DB_TABLE)
                ->cascadeOnDelete();

            $table->foreign(SalesReturnEnum::PRODUCT_ID)
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
        Schema::dropIfExists(SalesReturnEnum::DB_TABLE);
    }
};
