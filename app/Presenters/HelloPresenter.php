<?php


namespace App\Presenters;


class HelloPresenter
{
    private $x = 10;

    public function hello()
    {
        dump($this->x); die();
    }
}