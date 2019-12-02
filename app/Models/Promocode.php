<?php

namespace App\Models;

use App\Exceptions\MaxCountUsePromocodeException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


/**
 * Promocode
 *
 * @property int $id
 * @property string|null $name Промокод
 * @property int|null $value Размер скидки для заказа
 * @property int|null $max_use_count Максимальное кол-во использований
 * @property int $use_count
 * @method static Builder|Promocode whereUseCount($value)
 * @method static Builder|Promocode newModelQuery()
 * @method static Builder|Promocode newQuery()
 * @method static Builder|Promocode query()
 * @method static Builder|Promocode whereId($value)
 * @method static Builder|Promocode whereMaxUseCount($value)
 * @method static Builder|Promocode whereName($value)
 * @method static Builder|Promocode whereValue($value)
 * @mixin \Eloquent
 */
class Promocode extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'id',
        'name',
        'value',
        'max_use_count',
    ];

    protected $attributes = [
        'value' => null,
        'use_count' => 0,
        'max_use_count' => null,
        'name' => null,
    ];

    /**
     * Проверка промокода на импользование
     * @throws MaxCountUsePromocodeException
     */
    public function check()
    {
        if ($this->use_count >= $this->max_use_count) {
            throw new MaxCountUsePromocodeException();
        }
    }

    /**
     * Использование промокода
     */
    public function use()
    {
        $this->increment('use_count');
    }

}
