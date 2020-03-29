<?php


class Polozka
{
    private int $cenaCZK;
    private string $nazev;

    /**
     * @return int
     */
    public function getCenaCZK(): int
    {
        return $this->cenaCZK;
    }

    /**
     * @param int $cenaCZK
     */
    public function setCenaCZK(int $cenaCZK): void
    {
        $this->cenaCZK = $cenaCZK;
    }

    /**
     * @return string
     */
    public function getNazev(): string
    {
        return $this->nazev;
    }

    /**
     * @param string $nazev
     */
    public function setNazev(string $nazev): void
    {
        $this->nazev = $nazev;
    }
}