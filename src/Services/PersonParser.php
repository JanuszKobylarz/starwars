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

    public function create(string $json):Person{
        $obj = json_decode($json);
        $person = new Person();
        $person->setName($obj->name);
        $person->setBirthYear($obj->birth_year);
        $person->setHeight($obj->height);
        $person->setMass($obj->mass);
        $person->setEyeColor($obj->eye_color);
        $person->setGender($obj->gender);
        $person->setHairColor($obj->hair_color);
        $person->setSkinColor($obj->skin_color);
        $person->setMass($obj->mass);
        return $person;
    }
}