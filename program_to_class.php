<?php
class Calculator 
{
    private int $numberA = 0;  // Inicijaliziramo na 0
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
        return ($a ?? $this->numberA) + ($b ?? $this->numberB);
    }

    public function getSum(): int
    {
        return $this->sum();
    }
}

// Kreiranje instance klase
$calculator = new Calculator();

// Poziv metodâ
echo $calculator->getSum() . PHP_EOL; // Vratit će 0

$calculator->setA(7);
$calculator->setB(10);
echo $calculator->getSum() . PHP_EOL; // Vratit će 17 

echo $calculator->sum(4, 5) . PHP_EOL; // Vratit će 9 
?>

Definira se klasa Calculator: Sva funkcionalnost je unutar ove klase.

Privatne varijable: numberA i numberB su privatne varijable koje se koristi za pohranu brojeva.

Javne metode: 

setA(int $a) i setB(int $b) su metode za postavljanje vrijednosti.
sum(?int $a = null, ?int $b = null) izračunava sumu, pri čemu se koriste ili proslijeđene vrijednosti ili uskladištene vrijednosti.
getSum() je metoda koja vraća sumu koristeći trenutne vrijednosti numberA i numberB.
Instanciranje klase: Kreiramo novu instancu klase Calculator kroz $calculator.

Pozivanje metoda: Metode se pozivaju putem instanciranog objekta $calculator, što omogućava jednostavno korištenje funkcionalnosti klase.

Kao rezultat, kada se kod izvrši, ispisat će se:

CopyReplit
0
17
9