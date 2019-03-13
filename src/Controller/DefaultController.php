<?php
/**
 * Created by PhpStorm.
 * User: jkoby
 * Date: 13-03-2019
 * Time: 22:10
 */

namespace App\Controller;


use App\Services\CallApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class DefaultController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function test(){
        return $this->render("base.html.twig");
    }

}