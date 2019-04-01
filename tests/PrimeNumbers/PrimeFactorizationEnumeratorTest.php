<?php
namespace PrimeNumbers;

use PHPUnit\Framework\TestCase;

class PrimeFactorizationEnumeratorTest extends TestCase
{
    /**
     * @return array
     */
    public function primeFactorizationDataProvider(): array
    {
        return [
            [$this->getPrimeFactorization(2), $this->getPrimeFactorization(3)],
            [$this->getPrimeFactorization(3), $this->getPrimeFactorization(4)],
            [$this->getPrimeFactorization(4), $this->getPrimeFactorization(5)],
            [$this->getPrimeFactorization(5), $this->getPrimeFactorization(6)],
            [$this->getPrimeFactorization(6), $this->getPrimeFactorization(7)],
        ];
    }

    /**
     * @param int $number
     * @return Factorization
     */
    private function getPrimeFactorization(int $number): Factorization
    {
        $primeFactors = [];

        switch ($number) {
            case 1:
                $primeFactors = [1];
                break;
            case 2;
                $primeFactors = [2];
                break;
            case 3;
                $primeFactors = [3];
                break;
            case 4;
                $primeFactors = [2, 2];
                break;
            case 5;
                $primeFactors = [5];
                break;
            case 6;
                $primeFactors = [2, 3];
                break;
            case 7;
                $primeFactors = [7];
                break;
            default:
                trigger_error('Prime factorization for ' . $number . ' is not defined!');
        }

        return new Factorization($primeFactors);
    }

    //Check if a number is prime
    function isPrime($num, $pf = null)
    {
        if(!is_array($pf))
        {
            for($i=2;$i<intval(sqrt($num));$i++) {
                if($num % $i==0) {
                    return false;
                }
            }
            return true;
        } else {
            $pfCount = count($pf);
            for($i=0;$i<$pfCount;$i++) {
                if($num % $pf[$i] == 0) {
                    return false;
                }
            }
            return true;
        }
    }

//Find Prime Factors
    function primeFactors($num)
    {
        //Record the base
        $base = intval($num/2);
        $pf = array();
        $pn = null;
        for($i=2;$i <= $base;$i++) {
            if(isPrime($i, $pn)) {
                $pn[] = $i;
                while($num % $i == 0)
                {
                    $pf[] = $i;
                    $num = $num/$i;
                }
            }
        }
        return $pf;
    }

    /**
     * @dataProvider primeFactorizationDataProvider
     * @param Factorization $primeFactorization
     * @param Factorization $expectedSuccessorPrimeFactorization
     */
    public function testGetPrimeFactorizationReturnsThePrimeFactorizationOfTheSuccessor(
        Factorization $primeFactorization,
        Factorization $expectedSuccessorPrimeFactorization
    ) {
        $enumerator = new PrimeFactorizationEnumerator();

        $this->assertEquals(
            $expectedSuccessorPrimeFactorization,
            $enumerator->getPrimeFactorization($primeFactorization)
        );
    }
}
