<?php

namespace App\Services;

use App\Repositories\UserDbRepository;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserDbRepository $userDbRepository;

    public function __construct()
    {
        $this->userDbRepository = new UserDbRepository();
    }

    public function getItemList(): mixed
    {
        $result = $this->userDbRepository->getAllItem();
        if (empty($result)){
            return [];
        }
        return $result;
    }

    public function storeItem(array $formData): mixed
    {
        $formData['password'] = Hash::make($formData['password']);
        $result = $this->userDbRepository->storeData($formData);
        if (empty($result)){
            throw new \Exception('Invalid data format');
        }
        return $result;
    }

}
