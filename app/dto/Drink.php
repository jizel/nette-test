<?php


class Drink extends Polozka
{
    private bool $alko;


    public function isAlko(): bool
    {
        return $this->alko;
    }

    public function setAlko(bool $alko): void
    {
        $this->alko = $alko;
    }

}