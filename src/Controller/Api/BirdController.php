<?php

namespace App\Controller\Api;

use App\Models\BirdsModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/bird", name="api_bird_")
 */
class BirdController extends AbstractController
{
    /**
     * @Route("", name="list", methods={"GET"})
     */
    public function list(BirdsModel $birdsModel): Response
    {
        $birds = $birdsModel->getBirds();

        return $this->json($birds);
    }

    /**
     * @Route("", name="add", methods={"POST"})
     */
    public function add(): Response
    {
        
        $birdsModel = new BirdsModel();

        $birds = $birdsModel->getBirds();

        return $this->json($birds);
    }

}
