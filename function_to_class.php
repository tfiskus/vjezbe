<?php
function sum(int $a, int $b): int
{
    return $a + $b;
}

class Sum 
{
    private int $numberA = 0;  // Initialize to avoid undefined variable errors
    private int $numberB = 0;

    public function setA(int $a) 
    {
        $this->numberA = $a;
    }

    public function setB(int $b) 
    {
        $this->numberB = $b;
    }

    public function sum(?int $a = null, ?int $b = null): int
    {
        // Use the null coalescing operator (??) correctly and access the variables properly.
        return ($a ?? $this->numberA) + ($b ?? $this->numberB);
    }
}

$zbroj = new Sum();

// This will return 0
echo $zbroj->sum() . PHP_EOL;

$zbroj->setA(7);
$zbroj->setB(10);

// Will return 17
echo $zbroj->sum() . PHP_EOL; 

// Will return 9
echo $zbroj->sum(4, 5) . PHP_EOL; 

?>

