<?php

namespace App\Controller;

use App\Entity\Departure;
use App\Entity\Ticket;
use App\Entity\User;
use App\Repository\DepartureRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class TicketController extends AbstractController
{

    /**
     * @var string
     */
    private $form_path;

    /**
     * @var DepartureRepository
     */
    private $repository;

    /**
     * TicketController constructor.
     * @param DepartureRepository $repository
     */
    public function __construct(DepartureRepository $repository) {
        $this->form_path = 'pages/ticket/_form.html.twig';
        $this->repository = $repository;

    }

    /**
     * @Route("/{departure_id}/{user_id}/ticket/create", name="ticket.new")
     * @ParamConverter("departure", options={"mapping": {"departure_id": "id"}})
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     * @param User $user
     * @param Departure $departure
     * @return RedirectResponse
     */
    public function new(User $user, Departure $departure) {
        $ticket = new Ticket();
        $ticket->setUser($user)->setDeparture($departure);
        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);

        $departure->addOnePassenger();
        $em->persist($departure);

        $em->flush();
        return $this->redirectToRoute('home');
    }
}