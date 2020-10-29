<?php
namespace App\Controller;

use App\Repository\DepartureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param DepartureRepository $repository
     * @return Response
     */
    public function index(DepartureRepository $repository): Response {
        $departures = $repository->findAll();
        return $this->render('home.html.twig', [
            'departures' => $departures
        ]);
    }
}