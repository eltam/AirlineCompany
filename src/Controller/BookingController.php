<?php


namespace App\Controller;


use App\Entity\Client;
use App\Entity\Departure;
use App\Form\ClientType;
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
        $this->form_path = 'pages/_form.html.twig';
    }

    /**
     * @Route("/departure/{id}/booking/create", name="booking.new")
     * @param Request $request
     * @param Departure $departure
     * @return Response
     */
    public function new(Departure $departure, Request $request):Response {
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('pages/booking.html.twig', [
            'path' => $this->form_path,
            'departure' => $departure,
            'client' => $client,
            'form' => $form->createView()
        ]);

    }
}