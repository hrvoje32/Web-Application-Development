
<?php
// Task 1
$text = "Hello, world!";

// Print the value "Hello, world!" to the browser window using the variable above
// Don't worry about wrapping it in HTML at this point.

echo $text;


?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 2

$text = "This is lesson ";
$text2 = " of Web Application Development";
$number = 6;

// Print the value "This is lesson 6 of Web Application Development" to the browser window using the variables above
// Don't worry about wrapping it in HTML at this point.

// Your code goes here
echo $text . $number . $text2;

?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 3

// Fix the bugs in this code.

$text = 'The sum of ';
$text2 = ' plus ';
$text3 = ' is' ;
$number1 = 6;
$number2 = 14;

$total = $number1 + $number2;

echo $text . $number1. "+" .$number2 . $text3. " ". $total;

?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 4
// Write a PHP script that checks if a given number is even or odd.
// The script should take a variable $number and
//  use an if statement to output "Even" if the number is even and "Odd" if the number is odd.

$number = 771; // You can change this to test different numbers

// Your code goes here
if ($number % 2 == 0) {
    echo "Even";
} else {
    echo "Odd";
}
?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 5
// Write a function called calculateArea that takes two parameters, $length and $width, and returns the area of a rectangle.
// Call the function with values 5 and 8, then output the result.

function calculateArea($length, $width) {
    return $length * $width;
}

$result = calculateArea(4, 6);

echo "The area is: $result";
?>


-----------------------------------------------------------------------------------------------------------

<?php
// Task 6 identify datatype of variable

$var = 42;
$dataType = gettype($var);
echo "The data type of \$var is: $dataType";  

?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 7 identify datatype o string

$var = "Hello";

if (is_string($var)) {
    echo "\$var is a string.";
} else {
    echo "\$var is not a string.";
}

?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 8
// Write a PHP script to print the following pattern using a nested for loop:
//
// 1
// 22
// 333
// 4444
// 55555

$rows = 5;

for ($i = 1; $i <= $rows; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo $i;
    }
    echo "\n";
}

?>

-----------------------------------------------------------------------------------------------------------

<?php
// Task 9 
// Declare an array called $colors with the following colors: "Red", "Green", "Blue".
$colors = array("Red", "Green", "Blue");

// Add "Yellow" to the end of the array.
$colors[] = "Yellow";

// Use a foreach loop to print each color on a new line.
foreach ($colors as $color) {
    echo $color . "\n";
}

?>

---------------------------------------------------------------------------------------------------------

<?php
// Task 10
// Create a PHP function to calculate the total cost of items in a shopping cart.
// Each item in the cart has a price and a quantity.
// The function should take an array of items, where each item is represented as an associative array with keys 'price' and 'quantity'.

// Implement the calculateTotalCost function that calculates the total cost of the items in the cart
// and applies a discount based on the following conditions:

// If the total cost is greater than or equal to £100, apply a 10% discount.
// If the total cost is greater than or equal to £200, apply a 15% discount.
// The function should return the final total cost after applying any applicable discounts.

// Example data:
$cart = [
    ['price' => 25, 'quantity' => 2],
    ['price' => 50, 'quantity' => 1],
    ['price' => 30, 'quantity' => 3],
];

function calculateTotalCost($cart) {
    $totalCost = 0;

    foreach ($cart as $item) {
        $itemTotal = $item['price'] * $item['quantity'];
        $totalCost += $itemTotal;
    }

    // Discoounts based on the total cost
    if ($totalCost >= 100) {
        $discount = 0.10; // 10% discount
    } elseif ($totalCost >= 200) {
        $discount = 0.15; // 15% discount
    } else {
        $discount = 0; // No discount
    }

    // Calculate the discounted total cost
    $discountedTotalCost = $totalCost - ($totalCost * $discount);

    return $discountedTotalCost;
}

$total = calculateTotalCost($cart);
echo "Total Cost: £$total";

?>

---------------------------------------------------------------------------------------------------------

<?php
// Task 11
// Create a PHP function to calculate the Body Mass Index (BMI) of an individual based on their weight and height.

// BMI is calculated using the formula:
// BMI = weight in kilograms / (height in meters)^2

// The BMI categories are as follows.
// BMI less than 18.5: Underweight
// BMI between 18.5 and 24.9: Normal weight
// BMI between 25 and 29.9: Overweight
// BMI 30 or greater: Obese

// Implement a calculateBMI function that takes a person's weight in kilograms and height in meters as parameters
// and returns their BMI and category as an associative array.

// Example data:
$weight = 70; // in kilograms
$height = 1.75; // in meters

function calculateBMI($weight, $height) {
    // Calculate BMI
    $bmi = $weight / ($height * $height);

    // Health category
    if ($bmi < 18.5) {
        $category = "Underweight";
    } elseif ($bmi >= 18.5 && $bmi < 25) {
        $category = "Normal weight";
    } elseif ($bmi >= 25 && $bmi < 30) {
        $category = "Overweight";
    } else {
        $category = "Obese";
    }

    // Array with BMI and category
    $result = [
        'bmi' => $bmi,
        'category' => $category,
    ];

    return $result;
}

$result = calculateBMI($weight, $height);

echo "BMI: {$result['bmi']}";
echo "\n";
echo "Health Category: {$result['category']}";

?>

---------------------------------------------------------------------------------------------------------

<?php
// Task 12
// You are designing a PHP class to manage student grades.
// Each student has a name, an array of scores for different subjects, and a grade.
// The grade is determined based on the average score as follows:

//     Average score less than 50: Grade F
//     Average score between 50 and 59: Grade D
//     Average score between 60 and 69: Grade C
//     Average score between 70 and 79: Grade B
//     Average score 80 or greater: Grade A

// Implement calculateAverage and assignGrade methods to set the $average and $grade values for this class

class Student {
    private $name;
    private $scores;
    private $average;
    private $grade;

    public function __construct($name, $scores) {
        $this->name = $name;
        $this->scores = $scores;
        $this->calculateAverage();
        $this->assignGrade();
    }

    private function calculateAverage() {
        if (count($this->scores) > 0) {
            $sum = array_sum($this->scores);
            $this->average = $sum / count($this->scores);
        } else {
            $this->average = 0;
        }
    }

    private function assignGrade() {
        if ($this->average < 50) {
            $this->grade = 'F';
        } elseif ($this->average >= 50 && $this->average < 60) {
            $this->grade = 'D';
        } elseif ($this->average >= 60 && $this->average < 70) {
            $this->grade = 'C';
        } elseif ($this->average >= 70 && $this->average < 80) {
            $this->grade = 'B';
        } else {
            $this->grade = 'A';
        }
    }

    public function getGrade() {
        return $this->grade;
    }

    public function getStudentName() {
        return $this->name;
    }
}

// Example data:
$student1 = new Student('Alice', [75, 82, 90, 68]);
$student2 = new Student('Bob', [45, 60, 55, 70]);

echo "{$student1->getGrade()} grade for {$student1->getStudentName()}";
echo "\n";
echo "{$student2->getGrade()} grade for {$student2->getStudentName()}";


?>



         /\
       /\/\/\
     /\/\/\/\/\
   /\/\/\/\/\/\/\
 /\/\/\/\/\/\/\/\/\
/\/\/\/\/\/\/\/\/\/\
\/\/\/\/\/\/\/\/\/\/
 \/\/\/\/\/\/\/\/\/
  \/\/\/\/\/\/\/\/
   \/\/\/\/\/\/\/
    \/\/\/\/\/\/
     \/\/\/\/\/
      \/\/\/\/
       \/\/\/
        \/\/
         \/
