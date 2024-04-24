<?php

namespace App\Traits;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Crypt;

trait CryptTrait
{

    /**
     * @param  User  $user
     * @return string
     */
    public static function getTemplate(User $user)
    {
        return $user->id.'_'.$user->updated_at;
    }

    /**
     * @param $user
     * @return string
     */
    public static function encrypt($user)
    {
        return Crypt::encrypt(self::getTemplate($user));
    }

    /**
     * @param $code
     * @return false
     */
    public static function decrypt($code)
    {

        try {
            $currentLink = Crypt::decrypt($code);
            $id = explode('_', $currentLink)[0];
            $user = app(UserService::class)->getById($id);
            if ($currentLink !== $user->getStampTemplate()) {
                return false;
            }
        } catch (\Throwable $e) {
        }
        return $user ?? false;
    }
}
