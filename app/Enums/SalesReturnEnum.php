<?php

namespace App\Enums;

enum SalesReturnEnum
{
    public const DB_TABLE = "sale_returns";
    public const ID = "sale_return_id";
    public const SALE_ID = "sale_id";
    public const PRODUCT_ID = "product_id";
    public const RETURN_DATE = "return_date";
    public const RETURN_QUANTITY = "return_quantity";
    public const RETURN_AMOUNT = "return_amount";
    public const RETURN_REASON = "return_reason";
    public const PAYMENT_TYPE = "payment_type";
    public const PAYMENT_STATUS = "payment_status";

    public const ALL_FIELDS = [
        self::ID,
        self::SALE_ID,
        self::PRODUCT_ID,
        self::RETURN_QUANTITY,
        self::RETURN_AMOUNT,
        self::RETURN_REASON,
        self::RETURN_DATE,
        self::PAYMENT_TYPE,
        self::PAYMENT_STATUS,

    ];

    public const PAYMENT_TYPE_CASH = "cash";
    public const PAYMENT_TYPE_CARD = "card";

    public const PAYMENT_TYPE_LABELS = [
        "Cash" => self::PAYMENT_TYPE_CASH,
        "Card" => self::PAYMENT_TYPE_CARD,
    ];

    public const PAYMENT_STATUS_PAID = "paid";
    public const PAYMENT_STATUS_NOT_PAID = "not_paid";

    public const PAYMENT_STATUS_LABELS = [
        "Paid" => self::PAYMENT_STATUS_PAID,
        "Not Paid" => self::PAYMENT_STATUS_NOT_PAID,
    ];
}
