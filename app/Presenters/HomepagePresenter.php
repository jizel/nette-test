<?php

declare(strict_types=1);

namespace App\Presenters;

use http\Exception\InvalidArgumentException;
use Nette;
use Tracy\ILogger;
use User;
use Papos;
use Drink;
use Objednavka;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    var $x = 10;
    private $y = "Haf";
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderDefault(): void
    {
//        $pole = array("Karel", "Marek", "Evzen");
//        for ($i = 0; $i <= 2; $i++) {
//            if($i !== 1) {
//                $pole[$i] = $pole[$i] . " Trubicka";
//            }
//        }

        $this->template->posts = $this->database->table('drinky');
        $drinkyDb = $this->database->table('drinky');

        $userLasticka = $this->createUser("Lasticka", 29);
        $userZorzik = $this->createUser("Zorzik", 30);
        $userVocas = $this->createUser("Vocas", 16);

        $paposSvickova = $this->createPapos("Svica", false, true, 120, array("svickova", "korenovka", "knedlik"), 100);
        $paposFazole = $this->createPapos("Fazol",true, true, 20, array("fazole", "cibule", "kuskus"), 60);

        $drinkMojito = $this->createDrink("Mojito", true, 200);
        $drinkKombucha = $this->createDrink("Kombucha", false, 80);

//        $objednavka1 = $this->createObjednavka($userLasticka, array($paposFazole, $drinkKombucha));
        $objednavka1 = new Objednavka($userLasticka, array($paposFazole, $drinkKombucha));
        $objednavka1->setPoznamka("Poznamka k oibjednavce 1");

        dump($drinkyDb->fetchAll());

//        dump($objednavka1->__toString());
//        dump($objednavka1->getVyslednaCenaCZK());
//        dump($objednavka1->getPolozky()[0]->getNazev());
//        dump($objednavka1->getPolozky()[1]->getNazev());
        die();
    }

//    public function orderDrinks (User $user, Drink ...$drinks)
//    {
//       $suma =0;
//        foreach ($drinks as &$drink)
//        {
//            $suma=$suma+$drink->getCenaCZK();
//            if ($suma>$user->getPenizky())
//            {
//                throw new InvalidArgumentException("Nema penizky");
//            }
//            $user->setDrink($drink);
//        }
//    }

    public function vyplatPenizky(array $users, int $penizky)
    {
        foreach ($users as &$user) {
            $user->setPenizky($penizky);
        }
    }

    public function orderDrink(User $user, Drink $drink)
    {
        if ($this->muzeKoupit($user, $drink) && ($user->getPenizky() >= $drink->getCenaCZK())) {
            $user->setDrink($drink);
        } elseif (!$this->muzeKoupit($user, $drink)) {
            throw new InvalidArgumentException("Je moc mladej");

        } elseif ($user->getPenizky() < $drink->getCenaCZK()) {
            throw new InvalidArgumentException("Je nemajetny");
        }
    }

    private function muzeKoupit(User $user, Drink $drink): bool
    {
        if ($user->getVek() >= 18) {
            return true;
        }

        if ($user->getVek() < 18 && !$drink->isAlko()) {
            return true;
        }

        return false;
    }

    public function createDrink(string $nazev, bool $alko, int $cena): Drink
    {
        $drink = new Drink ();
        $drink->setNazev($nazev);
        $drink->setAlko($alko);
        $drink->setCenaCZK($cena);

        return $drink;
    }

    public function createPapos($nazev, $vegan, $teple, $casPripravyMin, $listIngredienci, $cenaCZK): Papos
    {
        $papos = new Papos();
        $papos->setNazev($nazev);
        $papos->setVegan($vegan);
        $papos->setTeple($teple);
        $papos->setCasPripravyMin($casPripravyMin);
        $papos->setListIngredianci($listIngredienci);
        $papos->setCenaCZK($cenaCZK);

        return $papos;

    }

    public function createUser($jmeno, $vek): User
    {
        $user = new User ();
        $user->setJmeno($jmeno);
        $user->setVek($vek);
        $user->setIsActive(true);
        $user->setPenizky(300);

        return $user;
    }

    public function createObjednavka($user, $polozky)
    {
        $objednavka = new Objednavka ();
        $objednavka->setUser($user);
        $objednavka->setPolozky($polozky);

        return $objednavka;
    }

    public function createUsers(): array
    {
        $userLasticka = $this->createUser("Lasticka", 29);
        $userZorzik = $this->createUser("Zorzik", 30);
        $userVocas = $this->createUser("Vocas", 16);

        $users = array($userLasticka, $userZorzik, $userVocas);

        return $users;
    }
}
