<?php 

namespace App\Service;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Validator\Constraints\Length;

class PracticeCodeService{

    public function __construct()
    {
        
    }

    public function RansomNote(string $ransomNote, string $magazine) :bool{
        
        //Create an array to count each letter in the alphabet
        $charCounter  = array_fill(0, 26,''); 
        //Count each character in the magazine string
        foreach(str_split($magazine) as $magChar){
            //Increment the counter for this character
            $charCounter[ord($magChar) - ord('a')]++; 
        }

        foreach(str_split($ransomNote) as $ransomLetter){
            if(--$charCounter[ord($ransomLetter) - ord('a')] < 0)
                return false;
        } 
        return true;
    }

    public function MaximumProfit(array $prices) : int{ 
        $maxProfit = 0;
        $lowestPrice = $prices[0];
        $profit = 0;

        for($i = 1; $i < count($prices); $i++){  
            if($prices[$i] < $lowestPrice)
                $lowestPrice = $prices[$i]; 

            $profit = $prices[$i] - $lowestPrice;

            if($profit > $maxProfit)
                $maxProfit = $profit; 
        }
        return $maxProfit;
    }

    public function MaxDifferenceBetweenIncreasingElements(array $nums) : int{
        $prev = 0; 
        $currentNumber = 0; 
        $difference = 0;

        $maxDiff = -1;
        $smallestNumber = $nums[0];

        for($i = 1; $i < count($nums); $i++){
            $prev = $nums[$i -1];
            $currentNumber = $nums[$i];

            if($smallestNumber > $currentNumber)
                $smallestNumber = $currentNumber;

            if($currentNumber > $prev)
            {
                $difference = $currentNumber - $smallestNumber;
                if($maxDiff < $difference)
                    $maxDiff = $difference;
            }
        }
        return $maxDiff;
    }

    public function RemoveDuplicates(array $nums) :int {
        $unique = array();
        $index = 0;
        if(count($nums) > 0 ){
            array_push($unique, $nums[0]);

            for($i = 1; $i < count($nums); $i++){
                if($nums[$i] != $nums[$i -1]){
                    $nums[$index++] = $nums[$i-1];
                    array_push($unique, $nums[$i]);
                }
            }
        }
        return count($unique);
    }
}
