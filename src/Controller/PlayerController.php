<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerController extends AbstractController
{
    /**
     * @Route("/player/{idPlayer}", name="player", requirements={"idPlayer"="\d+"})
     * @param int $idPlayer
     * @return Response
     */
    public function index(int $idPlayer): Response
    {
        return $this->render('player/index.html.twig', [
            'controller_name' => 'PlayerController',
        ]);
    }
}
