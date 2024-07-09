<?php

// include "Car.php";

function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
    die();
}


class Vlasnik {

    private string $ime;
    private string $prezime;
    private int $godine;
    private string $spol;
    private ?string $adresa;
    private array $cars;

    // dodavanje jednod objekta unutar druge klase naziva se Dependency injection
    public function __construct(string $ime, string $prezime, int $godine, string $spol, array $cars = [], ?string $adresa = null)
    {
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->godine = $godine;
        $this->spol = $spol;
        $this->adresa = $adresa;
        $this->cars = $cars;
    }

    public function hasMany()
    {
        return $this->cars;
    }
}

$car = new Car();
$car
    ->setMake('Tesla')
    ->setModel('Model S')
    ->setWeight(2300)
    ->setFuel('Electric');

$car1 = new Car();
$car1
    ->setMake('Tesla')
    ->setModel('Model 3')
    ->setWeight(1800)
    ->setFuel('Electric');

$tena = new Vlasnik('Tena', 'Fiskus', 31, 'Zensko', [$car, $car1]);
// dd($tena);