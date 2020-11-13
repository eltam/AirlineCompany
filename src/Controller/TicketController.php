<?php

namespace App\Controller;


use App\Repository\TicketRepository;
use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Departure;
use App\Entity\Ticket;
use App\Entity\User;
use App\Repository\DepartureRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\KernelInterface;
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
    private $departure_repository;

    /**
     * @var Pdf
     */
    private $pdf;
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * @var TicketRepository
     */
    private $ticket_repository;

    /**
     * TicketController constructor.
     * @param TicketRepository $ticket_repository
     * @param DepartureRepository $departure_repository
     * @param Pdf $pdf
     * @param KernelInterface $appKernel
     */
    public function __construct(TicketRepository $ticket_repository, DepartureRepository $departure_repository , Pdf $pdf, KernelInterface $appKernel) {
        $this->form_path = 'pages/ticket/_form.html.twig';
        $this->ticket_repository = $ticket_repository;
        $this->departure_repository = $departure_repository;
        $this->pdf = $pdf;
        $this->kernel = $appKernel;
    }

    /**
     * @Route("/{departure_id}/{user_id}/ticket/create", name="ticket.new")
     * @ParamConverter("departure", options={"mapping": {"departure_id": "id"}})
     * @ParamConverter("user", options={"mapping": {"user_id": "id"}})
     * @param User $user
     * @param Departure $departure
     * @return Response
     */
    public function new(User $user, Departure $departure)
    {
        $ticket = new Ticket();
        $ticket->setUser($user)->setDeparture($departure);
        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);

        $departure->addOnePassenger();
        $em->persist($departure);

        $em->flush();

        return $this->render('\pages\booking\ticket.html.twig', [
            'user' => $user,
            'ticket' => $ticket,
        ]);
    }


    /**
     * @Route("/{id}/ticket/show", name="ticket.show")
     * @param Ticket $ticket
     * @return Response
     */
    public function showTicket(Ticket $ticket) {
        $path = $this->kernel->getProjectDir();
        $snappy = new Pdf($path.'\vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf');
        $filename = sprintf($ticket->getId().'-'.$ticket->getUser()->getSurname().'-billet-%s.pdf', date('Y-m-d'));
        // $snappy->getOutputFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>')
        return new Response(
            $snappy->getOutputFromHtml($this->render('\pages\ticket\ticket.html.twig', ['ticket' => $ticket])),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }

    /**
     * @Route("/tickets/index", name="ticket.index")
     * @return Response
     */
    public function getUserTickets() {
        $user = $this->getUser();
        $tickets = $this->ticket_repository->findByUser($user);
        return $this->render('pages/mytickets/index.html.twig', [
            'tickets' => $tickets
        ]);
    }
}