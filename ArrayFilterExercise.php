<?php

function filterOnAmount($items)
{
if ($items>100){
    return true;
}
return false;
}
echo "Using a callback function\n";
$basket = ["Item1" => 75, "Item2" => 200, "Item3" => 125, "Item4" => 100];
print_r(array_filter($basket,"filterOnAmount"));

/* TC1 the array_filter function ( ) expects array + callback function (returns true or false)
 * if the callback returns true array_file() keeps value in original array, otherwise removes it
 * array_filter ($basket array and filterOnAmount callback function) uses string callback of function 'dynamic dispatch'
 * Applies to callback function logic (items>100) to each element in array.
 * Returns 200 and 125 in new array as only ones greater than 100
Q - is array_filter working as a HigherOrder function? */


// Using a closure to close-over (capture) a variable
echo "Using a callback function with a captured variable\n";
function criteria_greater_than($min)
{
    return function($item) use ($min){
        return $item > $min;
    }; 
}

$minimum = 95;
// Use array_filter on a input with a selected filter function
$output = array_filter($basket, criteria_greater_than($minimum));
$minimum = 105;
// Use array_filter on a input with a selected filter function
$output = array_filter($basket, criteria_greater_than($minimum));
print_r($output); // basket items > 95



// How does $min captured variable used within criteria_greater_than function give more flexibiliy than filter_array callback
// 
// 
// 
// 
// 
// 
// 
// Closures return an anonymous function from an outer function so they can access outer function's variables
// when anonFunc declared (criteria_greater_than), use USE$variable - captures value from scope when defined
// Closure provides local copy of value at the time function declared. Closes over at that moment.
// when declared criteria_greater_than function captures value of $min when criteria_greater_than defined (usually parameters disappear?)
// when criteria_greater_than($minimum) recalled, the $min logic (item>min) has been stored even when passing in new
// parameter of $minimum = 95. Has captured $min variable from when criteria_greater_than defined and later recalled
// subsequent changes to variable have no impact so if we change minimum????
// local copy of $min enclosed at time criteria_greater_than function is defined
// this is totally independent of the $minimum that is later defined 
// its using $min and $minimum - 2 variables, one is a function passing as parameters
// if we remove use($min) it prints out the WHOLE array
// compare with array_filter: closure allows for 2 pieces of logic, 1 is snapshot at the time so can change variable later and use both to
// be applied to each element in the array
// 
// Q how do we recognise anonymousfunctions as sometimes they have names!!!
// 
// dereferencing functions
// functions that return functions can be used as functions directly


// calling the function directly within an if statement
if (criteria_greater_than($minimum)($basket['Item1'])) {
    echo "It's more than $minimum\n";
}
else
{
    echo "It's NOT more than $minimum\n";
}


//if criteria_greater_than item greater than min, minimum 95
//$basket['item1] = key of item in associative array.
//this key to search for function logic in array - JUST THIS ONE? 
//GOOGLE TO SEARCH FOR????
?>

