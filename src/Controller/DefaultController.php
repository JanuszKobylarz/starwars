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
     * @Route("/")
     */
    public function test(CallApiService $apiCall, PersonParser $parser){
        $result = $apiCall->CallAPI("GET","people/1/");
        if(null == $result){
            //throw
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($parser->create($result));
        $em->flush();
        return $this->render("base.html.twig");
    }

}