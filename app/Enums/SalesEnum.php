<?php

namespace App\Enums;

enum SalesEnum
{
    public const DB_TABLE = "sales";
    public const ID = "sale_id";
    public const PRODUCT_ID = "product_id";
    public const CUSTOMER_ID = "customer_id";
    public const SALES_QUANTITY = "sale_quantity";
    public const SALES_PRICE = "sale_price";
    public const SALES_DATE = "sale_date";
    public const SALES_TOTAL = "sale_total";
    public const PAYMENT_TYPE = "payment_type";
    public const PAYMENT_STATUS = "payment_status";
    public const IS_RETURNED = "is_returned";

    public const ALL_FIELDS = [
        self::ID,
        self::PRODUCT_ID,
        self::CUSTOMER_ID,
        self::SALES_QUANTITY,
        self::SALES_PRICE,
        self::SALES_DATE,
        self::SALES_TOTAL,
        self::PAYMENT_TYPE,
        self::PAYMENT_STATUS,
        self::IS_RETURNED,
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
