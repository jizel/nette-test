<?php


class Objednavka
{

    private User $user;
    private array $polozky;
    private String $poznamka;

    public function __toString(): String
    {
        return "Jmeno: " . $this->user->getJmeno() . "\n Polozky: " . $this->jmenaPolozek() . "\nVysledna cena: " . $this->getVyslednaCenaCZK();
    }

    private function jmenaPolozek(): String
    {
        $vysledek = "";
        foreach ($this->polozky as &$polozka) {
            $vysledek = $vysledek . "\n" . $polozka->getNazev();
        }
        return $vysledek;
    }

    public function getVyslednaCenaCZK(): int
    {
        $suma = 0;
        foreach ($this->polozky as &$polozka)
        {
            $suma = $suma + $polozka->getCenaCZK();
        }

        return $suma;
    }

    public function __construct(User $user, array $polozky)
    {
        $this->user = $user;
        $this->polozky = $polozky;
    }

    public function getPoznamka(): String
    {
        return $this->poznamka;
    }


    public function setPoznamka(String $poznamka): void
    {
        $this->poznamka = $poznamka;
    }


    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getPolozky(): array
    {
        return $this->polozky;
    }

    public function setPolozky(array $polozky): void
    {
        $this->polozky = $polozky;
    }
}