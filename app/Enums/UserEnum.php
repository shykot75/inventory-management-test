<?php

namespace App\Enums;

enum UserEnum
{

    public const DB_TABLE = "users";
    public const ID = "id";
    public const NAME = "name";
    public const EMAIL = "email";
    public const PHONE = "phone";
    public const PASSWORD = "password";
    public const STATUS = "status";
    public const ROLE = "role";


    public const ALL_FIELDS = [
        self::ID,
        self::NAME,
        self::EMAIL,
        self::PHONE,
        self::PASSWORD,
        self::STATUS,
        self::ROLE,
    ];

    public const ROLE_ADMIN = "admin";
    public const ROLE_USER = "user";
    public const ROLE_LABELS = [
        "Admin" => self::ROLE_ADMIN,
        "User" => self::ROLE_USER,
    ];

    public const STATUS_ACTIVE = "1";
    public const STATUS_INACTIVE = "0";


}
