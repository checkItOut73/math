<?php
namespace PrimeNumbers;

use PrimeNumbers\Exceptions\TooFewFactorsException;

class Factorization
{
    /**
     * always sorted
     * @var int[]
     */
    private $factors = [];

    /**
     * @param int[] $factors
     */
    public function __construct(array $factors)
    {
        $this->factors = $factors;

        $this->normalizeFactors();
    }

    private function normalizeFactors()
    {
        sort($this->factors);

        foreach ($this->factors as $index => $factor) {
            if ($factor === 1) {
                unset($this->factors[$index]);
            }
        }

        $this->factors = array_values($this->factors);
    }

    /**
     * @return int[]
     */
    public function getFactors(): array
    {
        return $this->factors;
    }

    /**
     * @return int
     */
    public function getProduct(): int
    {
        $number = 1;

        foreach ($this->factors as $factor) {
            $number *= $factor;
        }

        return $number;
    }

    public function incrementBiggestFactor()
    {
        $this->factors[$this->getBiggestFactorIndex()]++;
    }

    public function decrementBiggestFactor()
    {
        $this->factors[$this->getBiggestFactorIndex()]--;

        $this->normalizeFactors();
    }

    /**
     * @return int
     */
    private function getBiggestFactorIndex(): int
    {
        return sizeof($this->factors) - 1;
    }

    public function incrementSecondBiggestFactor()
    {
        if (sizeof($this->factors) > 1) {
            $this->factors[$this->getSecondBiggestFactorIndex()]++;
        } else {
            array_unshift($this->factors, 2);
        }

        $this->normalizeFactors();
    }

    public function decrementSecondBiggestFactor()
    {
        if (sizeof($this->factors) === 1) {
            throw new TooFewFactorsException('Decrement of second biggest factor is not possible because there is just one!');
        }

        $this->factors[$this->getSecondBiggestFactorIndex()]--;

        $this->normalizeFactors();
    }

    /**
     * @return int
     */
    private function getSecondBiggestFactorIndex(): int
    {
        return sizeof($this->factors) - 2;
    }
}
