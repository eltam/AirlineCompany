<?php

namespace App\Controller;


use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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
    private $repository;

    /**
     * @var Pdf
     */
    private $pdf;
    /**
     * @var KernelInterface
     */
    private $kernel;

    /**
     * TicketController constructor.
     * @param DepartureRepository $repository
     * @param Pdf $pdf
     * @param KernelInterface $appKernel
     */
    public function __construct(DepartureRepository $repository , Pdf $pdf, KernelInterface $appKernel) {
        $this->form_path = 'pages/ticket/_form.html.twig';
        $this->repository = $repository;
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
    public function new(User $user, Departure $departure) {
        $ticket = new Ticket();
        $ticket->setUser($user)->setDeparture($departure);
        $em = $this->getDoctrine()->getManager();
        $em->persist($ticket);

        $departure->addOnePassenger();
        $em->persist($departure);

        $em->flush();

        $path = $this->kernel->getProjectDir();
        $snappy = new Pdf($path.'\vendor\wemersonjanuario\wkhtmltopdf-windows\bin\64bit\wkhtmltopdf');
        //$snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', '/tmp/bill-125.pdf');
        $filename = sprintf('test-%s.pdf', date('Y-m-d'));
        return new Response(
            $snappy->getOutputFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>'),
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
            ]
        );
    }
}