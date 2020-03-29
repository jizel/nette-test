<?php


class Papos extends Polozka
{
    private bool $vegan;
    private bool $teple;
    private int $casPripravyMin;
    private array $listIngredianci;

    public function isVegan(): bool
    {
        return $this->vegan;
    }

    public function setVegan(bool $vegan): void
    {
        $this->vegan = $vegan;
    }


    public function isTeple(): bool
    {
        return $this->teple;
    }


    public function setTeple(bool $teple): void
    {
        $this->teple = $teple;
    }


    public function getCasPripravyMin(): int
    {
        return $this->casPripravyMin;
    }


    public function setCasPripravyMin(int $casPripravyMin): void
    {
        $this->casPripravyMin = $casPripravyMin;
    }


    public function getListIngredianci(): array
    {
        return $this->listIngredianci;
    }


    public function setListIngredianci(array $listIngredianci): void
    {
        $this->listIngredianci = $listIngredianci;
    }


}