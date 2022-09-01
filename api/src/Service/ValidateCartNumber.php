<?php

namespace App\Service;

use App\Entity\CartNumber;
use Doctrine\ORM\EntityManagerInterface;

final class ValidateCartNumber
{

    public function __construct(private EntityManagerInterface $manager)
    {
        
    }

    public function validate($number) :?CartNumber
    {

        if ($this->checkNumber($number) == false || $this->checkNumberType($number) % 10 != 0 ) 
        {
             return null;
        }

        $validCart = $this->manager->getRepository(CartNumber::class)->findOneBy(['number' => $number]);

        if (!$validCart) {
            return null;
        }

        return $validCart;
    }

    private function checkNumber($number) {
        if (!is_numeric($number) || strlen($number) != 16) {
            return false;
        }
        return true;
    }

    private function checkNumberType($number)
    {
        $arrayNumber = str_split($number);
        $arrayNumberResult = [];
        $index = 1;
        foreach ($arrayNumber as $num) {
            $elementNumber = $num;
            if ($this->evenOdd($index) == 'even') {
                $elementNumber = $elementNumber * 1;
            } else {
                $elementNumber = $elementNumber * 2;
            }
            
            if ($elementNumber > 9) {
                $elementNumber = $elementNumber - 9;
            }
            $arrayNumberResult[] = $elementNumber;
            $index++;
        }

        return array_sum($arrayNumberResult);
    }

    private function evenOdd($number){
        if($number % 2 == 0){
            return "even"; 
        }
        else{
            return "odd";
        }
    }
}