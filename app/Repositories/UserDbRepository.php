<?php

namespace App\Repositories;

use App\Models\User;

class UserDbRepository
{private User $user;
    public function __construct()
    {
        $this->user = new User();
    }

    public function getAllItem(): mixed
    {
        return $this->user
            ->whereNull('deleted_at')
            ->latest()
            ->get();
    }

    public function storeData( array $data): mixed
    {
        return $this->user->create($data);
    }

}
