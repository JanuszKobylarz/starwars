<?php
/**
 * Created by PhpStorm.
 * User: jkoby
 * Date: 13-03-2019
 * Time: 22:10
 */

namespace App\Controller\Api;


use App\Entity\Person;
use App\Services\CallApiService;
use App\Services\PersonParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class DefaultController extends AbstractController
{

    /**
     * @Rest\Post("collector")
     * @param CallApiService $apiCall
     * @param PersonParser $parser
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getPeopleFromSwapi(CallApiService $apiCall, PersonParser $parser):JsonResponse{
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
        return $this->json(count($people).' people added.');
    }

    /**
     * @Rest\Get("name")
     * @param Request $request
     * @return JsonResponse
     */
    public function getPerson(Request $request, SerializerInterface $serializer):JsonResponse{
        $xx = $this->getDoctrine()->getRepository(Person::class)->findOneBy(['name' => $request->get('name')]);
        return $this->json($xx);
    }

}