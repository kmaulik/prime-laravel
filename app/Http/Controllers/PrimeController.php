<?php

namespace App\Http\Controllers;

class PrimeController extends Controller
{
    // Main function
    public function index()
    {
        $primesList = array();
        $sumsPrimeList = array(2);
        $primeSums = array();
        $target = 4000;
        $sieve = range(3, $target, 1);
        // create the prime list
        foreach ($sieve as $num) {
            if ($this->checkPrime($num)) { 
                $primesList[] = $num;
            }
        }
        // calculate the sum of prime list
        for ($i=1; $i < count($primesList); $i++) {
            $sumsPrimeList[$i] = $sumsPrimeList[$i-1] + $primesList[$i];
        }
        for ($i=1; $i < count($sumsPrimeList); $i++) {
            if ($this->checkPrime($sumsPrimeList[$i])) {
                $primeSums[$sumsPrimeList[$i]] = $i;
            }
            for ($j=1; $j < $i; $j++) {
                $thisSum = $sumsPrimeList[$i] - $sumsPrimeList[$j];
                if ($this->checkPrime($thisSum)) {
                    $primeSums[$thisSum] = $i - $j;
                }
            }
        }
        arsort($primeSums); //sort the prime sum according to prime key-value pair
        $largest = $this->calculateLargest($primeSums);
        echo "Largest prime number found is : ".$largest;
    }

    /*
    * function used to check number is prime or not
    */
    public function checkPrime($num)
    {
        if ($num == 1) {
            return false;
        }
        if ($num == 2) {
            return true;
        }
        if ($num % 2 == 0) {
            return false;
        }
        for ($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2) {
            if($num % $i == 0)
                return false;
        }
        return true;
    }

    /*
    * function used to find the largest number from the arraylist
    */
    public function calculateLargest($primeSums)
    {
        foreach ($primeSums as $key => $value) {
            if ($key <= 1000000) {
                return $key;
            }
        }
    }
    
}
