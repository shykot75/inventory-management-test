<?php

namespace App\Enums;

enum PurchaseEnum
{
    public const DB_TABLE = "purchases";
    public const ID = "purchase_id";
    public const PRODUCT_ID = "product_id";
    public const SUPPLIER_ID = "supplier_id";
    public const PURCHASE_QUANTITY = "purchase_quantity";
    public const PURCHASE_PRICE = "purchase_price";
    public const PURCHASE_DATE = "purchase_date";
    public const PURCHASE_TOTAL = "purchase_total";
    public const PAYMENT_TYPE = "payment_type";
    public const PAYMENT_STATUS = "payment_status";
    public const IS_RETURNED = "is_returned";


    public const ALL_FIELDS = [
        self::ID,
        self::PRODUCT_ID,
        self::SUPPLIER_ID,
        self::PURCHASE_QUANTITY,
        self::PURCHASE_PRICE,
        self::PURCHASE_DATE,
        self::PURCHASE_TOTAL,
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
