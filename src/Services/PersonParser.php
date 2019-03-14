<?php
/**
 * Created by PhpStorm.
 * User: jkoby
 * Date: 14-03-2019
 * Time: 19:05
 */

namespace App\Services;


use App\Entity\Person;

class PersonParser
{
    public function getNext(string $json):?string{
        $encoded = json_decode($json);
        return $encoded->next;
    }

    public function getPeople(string $json):array{
        $people = [];
        $encoded = json_decode($json);
        foreach ($encoded->results as $item){
            $people[] = $this->create($item);
        }
        return $people;
    }

    public function create($obj):Person{
        $person = new Person();
        $person->setName($obj->name);
        $person->setBirthYear($obj->birth_year);
        $person->setHeight(floatval($obj->height));
        $person->setMass(floatval($obj->mass));
        $person->setEyeColor($obj->eye_color);
        $person->setGender($obj->gender);
        $person->setHairColor($obj->hair_color);
        $person->setSkinColor($obj->skin_color);
        return $person;
    }
}