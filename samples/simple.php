<?php
include_once ("../src/residue.php");

//////////////////////////////////////////
//             setup
/////////////////////////////////////////

\residue\Residue::init("client.conf.json");

$logger = new \residue\Logger("sample-app");

class Car {
    public $engine;
    public $numberOfDoors;
    public function __toString() { 
        return "Car $this->engine with $this->numberOfDoors doors"; 
    }
}
$myCar = new Car();
$myCar->engine = 'V6 3.5';
$myCar->numberOfDoors = 4;

function call() {
    global $logger;
    $logger->debug("test");
}
call();

$logger->debug("another");

// array
$logger->info([1, 2]);

// object
$logger->info("blah %s this", $myCar);

// number
$logger->info(1234);
$logger->info(1234.233);

// formatted (see http://php.net/manual/en/function.sprintf.php)
$logger->info("test %s %s", 1, 2);


// verbose log
$logger->verbose(9, "this is msg %d ---", 123);

// you can manually flush in case something is pending in bulk request
// or leave it for library to take care of it
$logger->flush();

for ($i = 1; $i <= 100; ++$i) {
    $logger->info("This is request %d", $i);
}

echo "last msg\n";
