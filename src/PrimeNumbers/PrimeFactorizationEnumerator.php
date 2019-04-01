<?php
namespace PrimeNumbers;

class PrimeFactorizationEnumerator
{
    /**
     * @param Factorization $primeFactorizationOfPreviousNumber
     * @return Factorization
     */
    public function getPrimeFactorization(Factorization $primeFactorizationOfPreviousNumber)
    {
        $previousNumber = $primeFactorizationOfPreviousNumber->getProduct();
        $primeFactorization = new Factorization($primeFactorizationOfPreviousNumber->getFactors());

        $primeFactorization->decrementBiggestFactor();
        $primeFactorization->incrementSecondBiggestFactor();

        while ($previousNumber + 1 !== $primeFactorization->getProduct()) {
            if ($previousNumber + 1 > $primeFactorization->getProduct()) {
                $primeFactorization->incrementBiggestFactor();
            } else {
                $primeFactorization->decrementBiggestFactor();
            }
        }

        return $primeFactorization;
    }
}
