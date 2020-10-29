<?php

namespace App\Controller\Admin;

use App\Entity\Departure;
use App\Entity\Flight;
use App\Form\DepartureType;
use App\Repository\DepartureRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDepartureController extends AbstractController{

    /**
     * @var DepartureRepository
     */
    private $departure_repository;

    /**
     * @var string
     */
    private $form_path;

    /**
     * AdminDepartureController constructor.
     * @param DepartureRepository $departure_repository
     */
    public function __construct(DepartureRepository $departure_repository) {
        $this->departure_repository = $departure_repository;
        $this->form_path = 'admin/departure/_form.html.twig';
    }

    /**
     * @Route("/admin/departure",name="admin.departure.index")
     * @return Response
     */
    public function index(): Response {

        $departures = $this->departure_repository->findAll();
        return $this->render('admin/departure/index.html.twig', [
            'departures' => $departures
        ]);
    }

    /**
     * @Route("/admin/flight/{id}/departure/create", name="admin.departure.new")
     * @param Request $request
     * @param Flight $flight
     * @return Response
     */
    public function new(Flight $flight, Request $request):Response {
        $departure = new Departure();

        $departure->setFlight($flight);
        $departure->setPassengers("0");

        # We will find the last departure for this flight and set the new departure date on next week
        # If there is no previous departure, we will set the date on the next departure week day
        $latest_departure = $this->departure_repository->findLatestByFlight($flight);
        if(isset($latest_departure)) {
            $departure_date = $latest_departure->getDepartureDate();
            $departure_date->modify('+7 day');
        }
        else {
            $departure_week_day = $flight->getDepartDay();
            $departure_date = new DateTime();
            $departure_date->modify('next '.$departure_week_day);
        }

        $departure->setDepartureDate($departure_date);

        $form = $this->createForm(DepartureType::class, $departure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($departure);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.departure.index');
        }

        return $this->render('admin/new.html.twig', [
            'path' => $this->form_path,
            'type' => 'départ pour le vol '.$flight->getId(),
            'date_depart' => $departure_date->format('d/m/Y'),
            'departure' => $departure,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/departure/{id}", name="admin.departure.edit", methods="GET|POST")
     * @param Departure $departure
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Departure $departure, Request $request) {

        $form = $this->createForm(DepartureType::class, $departure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.departure.index');
        }

        return $this->render('admin/edit.html.twig', [
            'path' => $this->form_path,
            'departure' => $departure,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/departure/{id}", name="admin.departure.delete", methods="DELETE")
     * @param Departure $departure
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Departure $departure, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $departure->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($departure);
            $em->flush();
            $this->addFlash('success','Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.departure.index');
    }
}