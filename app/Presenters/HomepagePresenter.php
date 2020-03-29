<?php

declare(strict_types=1);

namespace App\Presenters;

use http\Exception\InvalidArgumentException;
use Nette;
use Tracy\ILogger;
use User;
use Papos;
use Drink;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    var $x = 10;
    private $y = "Haf";

    public function renderDefault(): void
    {
//        $pole = array("Karel", "Marek", "Evzen");
//        for ($i = 0; $i <= 2; $i++) {
//            if($i !== 1) {
//                $pole[$i] = $pole[$i] . " Trubicka";
//            }
//        }

//        foreach ($pole as &$value)
//        {
//            $value=$value." Trubicka";
//        }

//        $userLasticka=$this->createUser("Lasticka",29);
//        $userZorzik=$this->cr.eateUser("Zorzik", 30);
//
//       dump ($userZorzik);
//       dump($userLasticka);

        $users= $this->createUsers();
        foreach ($users as &$user)
        {
            if ($user->getVek()>=30)
            {
                $user->setVek($user->getVek()-1);
            }
        }

        $paposSvickova=$this->createPapos(false, true,120,array("svickova", "korenovka", "knedlik"));
        $paposFazole=$this->createPapos(true, true,20,array("fazole", "cibule", "kuskus"));

        $drinkMojito=$this->createDrink("Mojito", true, 200);
        $drinkKombucha=$this->createDrink("Kombucha", false, 80);

        $this->vyplatPenizky($users, 300);

        $this->orderDrink($users[0], $drinkMojito);
        $this->orderDrink($users[1],$drinkKombucha);
//        $this->orderDrink($users[2],$drinkMojito);

        $this->orderDrinks($users[1],$drinkMojito,$drinkMojito,$drinkKombucha);


        $users[0]->setPapos($paposSvickova);
        $users[1]->setPapos($paposFazole);




        dump($users);
       die();
    }

    public function orderDrinks (User $user, Drink ...$drinks)
    {
       $suma =0;
        foreach ($drinks as &$drink)
        {
            $suma=$suma+$drink->getCenaCZK();
            if ($suma>$user->getPenizky())
            {
                throw new InvalidArgumentException("Nema penizky");
            }
            $user->setDrink($drink);
        }
    }

    public function vyplatPenizky (array $users, int $penizky)
    {
        foreach ($users as &$user)
        {
        $user->setPenizky($penizky);
        }
    }

    public function orderDrink(User $user, Drink $drink)
    {
       if ($this->muzeKoupit($user, $drink) && ($user->getPenizky()>=$drink->getCenaCZK()))
       {
           $user->setDrink($drink);
       }

       elseif (!$this->muzeKoupit($user, $drink))
       {
           throw new InvalidArgumentException("Je moc mladej");

       }

       elseif (!$user->getPenizky()>=$drink->getCenaCZK())
       {
           throw new InvalidArgumentException("Je nemajetny");
       }
    }

    private function muzeKoupit (User $user, Drink $drink): bool
    {
        if ($user->getVek()>=18)
        {
           return true;
        }

        if ($user->getVek()<18 && !$drink->isAlko())
        {
           return true;
        }

        return false;
    }

    public function createDrink ($nazev, $alko, $cena): Drink
    {
        $drink=new Drink ();
        $drink->setNazev($nazev);
        $drink->setAlko($alko);
        $drink->setCenaCZK($cena);

        return $drink;
    }

    public function createPapos ($vegan, $teple, $casPripravyMin, $listIngredienci): Papos
    {
        $papos=new Papos();
        $papos->setVegan($vegan);
        $papos->setTeple($teple);
        $papos->setCasPripravyMin($casPripravyMin);
        $papos->setListIngredianci($listIngredienci);

        return $papos;

    }

    public function createUser($jmeno, $vek): User
    {
        $user = new User ();
        $user->setJmeno($jmeno);
        $user->setVek($vek);
        $user->setIsActive(true);

        return $user;
    }

    public function createUsers (): array
    {
        $userLasticka=$this->createUser("Lasticka",29);
        $userZorzik=$this->createUser("Zorzik", 30);
        $userVocas=$this->createUser("Vocas", 16);

        $users=array($userLasticka, $userZorzik,$userVocas);

        return $users;
    }
}
