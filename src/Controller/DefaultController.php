<?php
namespace App\Controller;


use App\Entity\Participant;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\News;
use App\Entity\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\EntityToArrayGenerator;
use Symfony\Component\HttpFoundation\Request;
use App\Service\SessionRegistrator;

class DefaultController extends Controller
{


    /**
     * @Route("/api/Table/{tableName}/{id}", requirements={"id"="\d+"}, methods={"POST"})
     */
    public function index($tableName, $id = null, Request $request, EntityToArrayGenerator $generator)
    {
        $arr = $generator->job($tableName, $id);

        if(!$arr){
            return $this->setMessage("Error", [], "Not found");
        }

        return $this->setMessage("Ok", $arr, "");
    }



    /**
     * @Route("/api/SessionSubscribe/{sessionId}/{userEmail}", requirements={"sessionId"="\d+"}, methods={"POST"})
     */
    public function session($sessionId, $userEmail, SessionRegistrator $sessionRegistrator)
    {
        $res = $sessionRegistrator->job($sessionId, $userEmail);
        return new JsonResponse($res);
    }



    private function setMessage($status, $payload, $message)
    {
        return new JsonResponse([
            "status"    => $status,
            "payload"   => $payload,
            "message"   => $message
        ]);
    }
}