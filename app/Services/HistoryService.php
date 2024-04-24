<?php
namespace App\Services;

use App\Models\History;
use Illuminate\Database\Eloquent\Model;
use Random\RandomException;

class HistoryService extends BaseService
{
    public function __construct(History $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $user
     * @return Model
     * @throws RandomException
     */
    public function createNew($user)
    {
        return $this->store([
            'user_id' => $user->id,
            'number' => random_int(config('app.mix_number'), config('app.max_number')),
        ]);
    }

    /**
     * @param $user
     * @return Model
     * @throws RandomException
     */
    public function lastItems($user)
    {
        return $this->model->where('user_id', '=', $user->id)->orderByDesc('created_at')->limit(3)->get();
    }
}
