<?php

namespace App\Controller\Admin;

use App\Repository\DepartureRepository;
use App\Repository\TicketRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminStatisticsController extends AbstractController {

    /**
     * @Route("/admin/statistics",name="admin.statistics.index")
     * @param UserRepository $userRepository
     * @param TicketRepository $ticketRepository
     * @param DepartureRepository $departureRepository
     * @return Response
     */
    public function index(UserRepository $userRepository, TicketRepository $ticketRepository, DepartureRepository $departureRepository): Response {
        $total_clients = $userRepository->findAllCount();

        $total_tickets_next_departures = $ticketRepository->findNextCount();

        $total_places_next_departures = 0;
        $next_departures = $departureRepository->findAllNext();
        foreach ($next_departures as $departure) {
            $places = $departure->getFlight()
                ->getAircraft()
                ->getModel()
                ->getCapacity();
            $total_places_next_departures += $places;
        }

        $fill_percentage = ($total_tickets_next_departures / $total_places_next_departures) * 100;
        $fill_percentage = round($fill_percentage,2);

        return $this->render('admin/statistics/index.html.twig', [
            'total_clients' => $total_clients,
            'total_tickets_next_departures' => $total_tickets_next_departures,
            'total_places_next_departures' => $total_places_next_departures,
            'fill_percentage' => $fill_percentage,

        ]);
    }
}