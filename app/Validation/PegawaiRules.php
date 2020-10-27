<?php

namespace App\Validation;

use App\Models\PegawaiModel;

class PegawaiRules
{

    public function validateUser(string $str, string $fields, array $data)
    {
        $model = new PegawaiModel();

        $user = $model->where('username', $data['username'])
                      ->first();

        if(!$user){
            return false;
        }
            
        return password_verify($data['password'], $user['password']);
    }
}
