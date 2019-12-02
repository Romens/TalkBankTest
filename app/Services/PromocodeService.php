<?php

namespace App\Services;

use App\Exceptions\MaxCountUsePromocodeException;
use App\Models\Promocode;

class PromocodeService
{

    /**
     * @var string
     */
    private $alphabet;
    /**
     * @var int
     */
    private $alphabetLength;
    /**
     * @var int
     */
    private $maxPromocodeLength;
    /**
     * @var string
     */
    private $fillString;

    /**
     * PromocodeService constructor.
     * @param string $alphabet
     * @param int $maxPromocodeLength
     * @param string|null $fillString
     */
    public function __construct(string $alphabet, int $maxPromocodeLength, string $fillString = null)
    {
        $this->alphabet = $alphabet;
        $this->alphabetLength = strlen($alphabet);
        $this->maxPromocodeLength = $maxPromocodeLength;
        $this->fillString = $fillString ?? $alphabet[0];
    }

    /**
     * Генерация промокода
     * @param int $value
     * @param int $maxUseCount
     * @param string|null $name
     * @return Promocode
     */
    public function genPromocode(int $value, int $maxUseCount, ?string $name = null) : Promocode
    {

        $promocode = new Promocode([
            'value' => $value,
            'name' => $name,
            'max_use_count' => $maxUseCount,
        ]);
        $promocode->save();
        $promocode->name = $this->_genPromocode($promocode->id);
        $promocode->save();

        return $promocode;
    }

    /**
     * Использование промокода
     * @param string $promocodeName
     * @return int
     * @throws MaxCountUsePromocodeException
     */
    public function usePromocode(string $promocodeName) : int
    {
        /** @var Promocode $promocode */
        $promocode = Promocode::whereName($promocodeName)->first();

        $promocode->check();

        $promocode->use();

        return $promocode->value;
    }


    /**
     * Генерация промокода по его уникальному значению в БД
     * @param int $id
     * @return string
     */
    private function _genPromocode(int $id) : string
    {
        $uniq = $this->_decimalToAlphabet($id, $this->alphabet);

        return str_pad($uniq, $this->maxPromocodeLength, $this->fillString);
    }

    /**
     * @param int $decimal
     * @param string $alphabet
     * @return string
     */
    private function _decimalToAlphabet(int $decimal, string $alphabet)
    {
        $result = [];
        $div = $decimal;

        do {
            $result[] = $div % $this->alphabetLength;

            $div = intdiv($div, $this->alphabetLength);

        } while($div > $this->alphabetLength);

        $result[] = $div;
        $result = array_map(function ($int) use ($alphabet) {
            return $alphabet[$int];
        }, $result);

        return implode('', array_reverse($result));
    }

}