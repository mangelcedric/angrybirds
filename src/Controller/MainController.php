<?php

namespace App\Controller;

use App\Models\BirdsModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="bird_")
 */
class MainController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function birdsList(): Response
    {
        $birdsModel = new BirdsModel();

        $birds = $birdsModel->getBirds();

        return $this->render('main/index.html.twig', [
            'birds' => $birds,
        ]);
    }

    /**
     * @Route("bird/{id}", name="single", requirements={"id": "\d+"})
     */
    public function bird(int $id): Response
    {
        $birdsModel = new BirdsModel();
        
        $bird = $birdsModel->getOneBird($id);
        if ($bird === null) {
            throw $this->createNotFoundException();
        }

        $session = new Session();
        $session->set('lastBird', $id);

        return $this->render('main/detail.html.twig', [
            'bird' => $bird,
        ]);
    }

    /**
     * @Route("calendar", name="calendar")
     */
    public function calendar()
    {
        return $this->file(__DIR__ . '/../../../sources/angry_birds_2015_calendar.pdf');
    }
}
