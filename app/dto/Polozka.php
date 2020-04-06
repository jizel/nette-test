<?php


abstract class Polozka
{
    private int $cenaCZK;
    protected string $nazev;

    public function getCenaCZK(): int
    {
        return $this->cenaCZK;
    }

    public function setCenaCZK(int $cenaCZK): void
    {
        $this->cenaCZK = $cenaCZK;
    }

    abstract public function getNazev(): string;

    public function setNazev(string $nazev): void
    {
        $this->nazev = $nazev;
    }
}