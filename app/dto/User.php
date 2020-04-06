<?php


class User
{

    private string $jmeno;
    private int $vek;
    private bool $isActive;
    private Papos $papos;
    private Drink $drink;
    private int $penizky;


//    public function __construct($jmeno, $vek, $papos, $drink)
//    {
//        $this->jmeno=$jmeno;
//        $this->vek=$vek;
//        $this->papos=$papos;
//        $this->drink=$drink;
//        $this->isActive=true;
//
//    }

    public function getPenizky(): int
    {
        return $this->penizky;
    }


    public function setPenizky(int $penizky): void
    {
        $this->penizky = $penizky;
    }

    public function getDrink(): Drink
    {
        return $this->drink;
    }


    public function setDrink(Drink $drink): void
    {
        $this->drink = $drink;
    }


    public function getPapos(): Papos
    {
        return $this->papos;
    }


    public function setPapos(Papos $papos): void
    {
        $this->papos = $papos;
    }


    public function getJmeno()
    {
        return $this->jmeno;
    }

    public function getVek()
    {
        return $this->vek;
    }

    public function setJmeno($jmeno): void
    {
        $this->jmeno = $jmeno;
    }

    public function setVek($vek): void
    {
        $this->vek = $vek;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }


}