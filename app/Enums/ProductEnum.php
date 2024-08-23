<?php

namespace App\Enums;

enum ProductEnum
{

    public const DB_TABLE = "products";
    public const ID = "product_id";
    public const CATEGORY_ID = "category_id";
    public const PRODUCT_NAME = "product_name";
    public const PRODUCT_SKU = "sku";
    public const PRODUCT_PRICE = "product_price";
    public const PRODUCT_QUANTITY = "quantity";
    public const PRODUCT_IMAGE = "product_image";
    public const PRODUCT_DESCRIPTION = "product_description";
    public const PRODUCT_STATUS = "status";


    public const ALL_FIELDS = [
        self::ID,
        self::CATEGORY_ID,
        self::PRODUCT_NAME,
        self::PRODUCT_SKU,
        self::PRODUCT_PRICE,
        self::PRODUCT_QUANTITY,
        self::PRODUCT_IMAGE,
        self::PRODUCT_DESCRIPTION,
        self::PRODUCT_STATUS
    ];

    public const STATUS_ACTIVE = "1";
    public const STATUS_INACTIVE = "0";


}
