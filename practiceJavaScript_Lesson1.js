 // Problem 4.01 - Mathematical operator challenge
 const num1 = 20;
 const num2 = 5;
 const num3 = 24;
 // Insert only mathematical operators into the line of code below
 const result = (num1 * num2 + num3) % 120;
 // The expected result is 4
 console.log(result);




  // Problem 4.02 - String Concatenation
  const string1 = "Arden ";
  const string2 = "School of Computing";
  const string3 = "University - ";
  // Insert only variable names into the line of code below
  const result = string1 + string3 + string2;
  // The expected result is "Arden University - School of Computing"
  console.log(result);



   // Activity 4.03 - Temperature Conversion
   const tempInF = 68;
   // Alter the line of code below to use the value of temperature in Farenheit to set the temperature in Celcius
   const tempInC = (tempInF - 32) * 5 / 9;
   // Expected output: "20 degrees celcius"
   console.log(tempInC + " degrees celcius");


    // Activity 4.04 - Bug fixing
        // The code below is not working. The expected sum of the two numbers is 70.
        // Fix all of the bugs so that it correctly adds 5 to 65.
        const number1 = 5; 
        let number2;
        number2 = 65;
        let result = number1 + number2;
        // Expected output: 70
        console.log(result);



  // Activity 4.05 - Bug fixing 2
        // The code below is not working. The expected output is "Hello, world!".
        // Fix all of the bugs so that the 3 variables combine to give the correct output.
        const text = 'world';
        const text2 = 'Hello';
        let text3;
        text3 = '!';
        let result = text2 + ', ' + text + text3;
        // Expected output: "Hello, world!"
        console.log(result);        





// Activity 4.06 - Conditional checks
        // Use a switch statement to print a message to the console,
        // based on the datatype of the variable passed to the "checkType" function
        // Do not use if-else, or rewrite the function other than to add the switch statement 
    
        let variable1 = "Hello, world!";
        let variable2 = 22;
        let variable3 = "22";
        let variable4 = true;
        let variable5 = -46;
        
        function checkType(variable) {
            let varType = typeof(variable);

            switch(varType) {
                case 'string':
                    return "This is a string";
                case 'number':
                    return "This is a number";
                case 'boolean':
                    return "This is a boolean";
                default:
                    return "Unknown type";
            }

        }

        // Expected output:
        //            "This is a string"
        //            "This is a number"
        //            "This is a string"
        //            "This is a boolean"
        //            "This is a number"
        console.log(checkType(variable1));
        console.log(checkType(variable2));
        console.log(checkType(variable3));
        console.log(checkType(variable4));
        console.log(checkType(variable5));





        // Activity 4.07 - Conditional checks 2
        // Use if-else to only print numbers greater than zero to the console
        // Otherwise print "Not a positive number"
        
        let variable1 = -15;
        let variable2 = 22;
        let variable3 = 0;
        let variable4 = 76;
        let variable5 = -46;
        
        function checkNumber(variable) {
            
            if (variable > 0) {
                console.log(variable);
            } else {
                console.log("Not a positive number");
            }

        }

        // Expected output:
        //            "Not a positive number"
        //            22
        //            "Not a positive number"
        //            76
        //            "Not a positive number"
        
        checkNumber(variable1);
        checkNumber(variable2);
        checkNumber(variable3);
        checkNumber(variable4);
        checkNumber(variable5);



// Activity 4.08 - While loop
        // Use a while loop and an if statement to print all of the odd numbers up to 20

        let counter = 0;
          
        // Expected output:
        //            1
        //            3
        //            5
        //            7
        //            etc.
        
        while (counter <= 40) {
            if (counter % 2 !== 0) { 
                console.log(counter);
            }
            counter++;
        }


// Activity 4.09 - for loop
        // Use nested for loops to print all of the prime numbers up to 50

        let max_num = 50;

        // Expected output:
        //            1
        //            3
        //            5
        //            7
        //            etc.
        
        for (let num = 2; num <= max_num; num++) {
            let isPrime = true;
        
            // Check divisibility for numbers less than the current number
            for (let divisor = 2; divisor < num; divisor++) {
                if (num % divisor === 0) {
                    isPrime = false;
                    break; // Exit the inner loop if the number is not prime
                }
            }
        
            if (isPrime) {
                console.log(num); // Print the prime number
            }
        }


 // Activity 4.10 - foreach loop
        // Use a forEach loop to sum all of the values in an array
        // Print the total value to the console

        let arr = [5, 24, -3, 22, 15, 12, 100];

        // Expected output:
        //            175
        
        let sum = 0;

        arr.forEach(function(number) {
            sum += number;
        });

       console.log(sum); 