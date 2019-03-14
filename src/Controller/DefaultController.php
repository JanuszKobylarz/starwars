<?php
/**
 * Created by PhpStorm.
 * User: jkoby
 * Date: 13-03-2019
 * Time: 22:10
 */

namespace App\Controller;


use App\Services\CallApiService;
use App\Services\PersonParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    /**
     * @Route("/collector")
     */
    public function test(CallApiService $apiCall, PersonParser $parser){
        $people = [];
        $url = "https://swapi.co/api/people/";

        do{
            $result = $apiCall->CallAPI("GET",$url);
            $people = array_merge($people, $parser->getPeople($result));
        }while($url = $parser->getNext($result));

        $em = $this->getDoctrine()->getManager();
        foreach ($people as $person) {
            $em->persist($person);
        }
        $em->flush();
        return $this->render("base.html.twig");
    }

}