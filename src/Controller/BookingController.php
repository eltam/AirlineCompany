<?php


namespace App\Controller;

use App\Entity\Departure;
use App\Repository\DepartureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookingController extends AbstractController
{

    /**
     * @var string
     */
    private $form_path;

    public function __construct() {
        $this->form_path = 'pages/booking/_form.html.twig';
    }

    /**
     * @Route("/booking/index", name="booking.index")
     * @param DepartureRepository $repository
     * @return Response
     */
    public function index(DepartureRepository $repository): Response {
        $departures = $repository->findAllNext();
        return $this->render('pages/booking/index.html.twig', [
            'departures' => $departures
        ]);
    }

    /**
     * @Route("/departure/{id}/booking/create", name="booking.new")
     * @param Request $request
     * @param Departure $departure
     * @return Response
     */
    public function new(Departure $departure, Request $request):Response {
        $user = $this->getUser();

        return $this->render('pages/booking/booking.html.twig', [
            'path' => $this->form_path,
            'departure' => $departure,
            'user' => $user,
        ]);

    }
}