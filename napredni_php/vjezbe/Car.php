<?php

include 'Vlasnik.php';
// declare(strict_types=1);

class Car {

    private string $make; // proizvodjac
    private string $model; // model
    private string $fuel; // gorivo
    private int $weight; // masa
    private Vlasnik $vlasnik;

    public function __construct(){}

    public function belongsTo()
    {
        return $this->vlasnik;
    }

    public function setVlasnik(Vlasnik $vlasnik)
    {
        $this->vlasnik = $vlasnik;
        return $this;
    }

    public function getFullName()
    {
        return "$this->make - $this->model";
    }

    public function getMake()
    {
        return $this->make;
    }

    public function setMake(string $make)
    {
        $this->make = $make;
        return $this;
    }
    
    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $var)
    {
        $this->model = $var;
        return $this;
    }
    
    public function getWeight(): int
    {
        return $this->weight;
    }

    public function setWeight(int $weight)
    {
        $this->weight = $weight;
        return $this;
    }

    public function getFuel(): string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;
        return $this;
    }

    public function toArray()
    {
        return [
            'make' => $this->make,
            'model' => $this->model,
            'fuel' => $this->fuel,
            'weight' => $this->weight,
        ];
    }
}

$vlasnik = new Vlasnik("alex", "d", 39, 'M');

$tesla = new Car();
$tesla
    ->setMake('Tesla')
    ->setModel('Model S')
    ->setWeight(2300)
    ->setFuel('Electric')
    ->setVlasnik($vlasnik);



// dd($tesla->belongsTo());

