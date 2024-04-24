<?php

namespace App\Models;

use App\Traits\CryptTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, CryptTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone_number',
        'stamp'
    ];

    /**
     * @return HasMany
     */
    public function history()
    {
        return $this->hasMany(History::class);
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return self::encrypt($this);
    }

    /**
     * @return string
     */
    public function getStampTemplate()
    {
        return self::getTemplate($this);
    }
}
