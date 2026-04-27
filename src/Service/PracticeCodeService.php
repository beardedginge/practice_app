<?php 

namespace App\Service;

use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
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

    public function SortGrades(array $grades) : array {
        //80, 90, 30, 4, 50, 70, 20
        //into 80, 90, 50, 70 30, 4, 20
        $left  = 0;
        $right = count($grades) - 1;

        while($left < $right){            
            while($left < count($grades) && $grades[$left] >= 50)
                $left++;
            while($right >=0 && $grades[$right] < 50)
                $right--;

            if($left < $right){
                $temp = $grades[$left];
                $grades[$left] = $grades[$right];
                $grades[$right] = $temp;

                $left++;
                $right--;
            }
        }
        return $grades;
    }

    public function PalindromeNumber($number) : bool{
        return $number == strrev($number) ? true : false;
    }

    //Generic tree -> We dont know the structure
    function collectValues($data, array &$result = [])
    {
        if (!is_array($data)) {
            return $result;
        }

        foreach ($data as $value) {

            if (is_array($value)) {
                $this->collectValues($value, $result);
            } else {
                $result[] = $value;
            }
        }

        return $result;
    }

    //We dont know the structure, and we want to count how far we go down
    public function TreeTraversal($nodes, int $depth = 0, array &$result = []): array
    {
        // Loop through each node in the current level of the tree
        foreach ($nodes as $node) {
 
            // This protects against malformed or mixed data
            if (is_array($node)) {

                // If the node is marked as completed, collect it 
                if (isset($node['completed']) && $node['completed']) {
                    $result[] = [
                        'id' => $node['id'],
                        'name' => $node['name'],  
                        'depth' => $depth,                  // Track how deep this node is
                        'completed' => $node['completed'] 
                    ];
                }

                // Traverse ALL child arrays within the current node 
                foreach ($node as $value) {

                    // If a value is itself an array, it could be nested nodes
                    if (is_array($value)) {
                         $this->TreeTraversal($value, $depth + 1, $result);
                    }
                }
            }
        }
        // Return the accumulated results after full traversal
        return $result;
    }

    public function TotalByCustomerArray($orders) : array{
        $totals = [];

        foreach ($orders as $order) {
            //grab the customer customer
            $customer = $order['customer'];

            //no customers, set the total to zero
            if (!isset($totals[$customer])) {
                $totals[$customer] = 0;
            }

            //if they have ordered, and there is an array, grab the totals
            if (!empty($order['items']) && is_array($order['items'])) {
                foreach ($order['items'] as $item) {
                    $totals[$customer] += $item['price'] * $item['quantity'];
                }
            }
        } 
        return $totals;
    }

    public function APIChallenge($apiResponse) : array {
        $return = [];

        foreach ($apiResponse['data'] as $user) {

            $name = $user['first_name'] . " " . $user['last_name'];
            $orders = $user['orders'] ?? 0;

            $return[$user['user_id']] = $name . " (" . $orders . " orders)";
        }

        return $return;
    }

    public function APIChallenge2($apiResponse): array
    {
        // Final result array that will be returned to controller/Twig
        $return = [];

        // Loop through each user in the API response
        // We assume structure: $apiResponse['users'] = list of users
        foreach ($apiResponse['users'] as $users) {

            // Reset total for EACH user 
            $total = 0; 

            // Ensure 'orders' exists and is actually an array before looping
            if (!empty($users['orders']) && is_array($users['orders'])) {

                // Loop through each order for this user
                foreach ($users['orders'] as $order) {

                    // Safely add order amount to total
                    // Using ?? 0 prevents errors if 'amount' is missing
                    $total += $order['amount'] ?? 0;
                }
            }

            // Build final structure per user
            // Keyed by user ID so we can easily access in Twig
            $return[$users['id']] = [
                // Combine first + last name into a display-friendly string
                "full_name" => trim($users['first_name'] . " " . $users['last_name']), 
                "total_spent" =>  $total
            ];
        }
 
        return $return;
    }
}