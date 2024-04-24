<?php
namespace App\Services;

use App\Models\User;
use App\Traits\CryptTrait;
use Illuminate\Database\Eloquent\Model;

class UserService extends BaseService
{
    use CryptTrait;

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $data
     * @return Model
     */
    public function storeUser($data)
    {
        $user = $this->getOneBy($data) ;
        if ($user === null) {
            $data['stamp'] = self::_getStamp();
            $user = $this->store($data);
        }

        return $user;
    }

    /**
     * @param  User  $user
     * @return string
     */
    public function getNewLink(User $user)
    {
        $user->update(['stamp' => self::_getStamp()]);

        return self::encrypt($user);
    }

    /**
     * @return mixed
     */
    private static function _getStamp()
    {
        return microtime();
    }
}
