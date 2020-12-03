<?php

namespace App\Controller\Admin;


use App\Entity\Flight;
use App\Form\FlightType;
use App\Repository\FlightRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFlightController extends AbstractController{

    /**
     * @var FlightRepository
     */
    private $flight_repository;

    /**
     * @var string
     */
    private $form_path;

    /**
     * AdminAirportController constructor.
     * @param FlightRepository $flight_repository
     */
    public function __construct(FlightRepository $flight_repository) {
        $this->flight_repository = $flight_repository;
        $this->form_path = 'admin/flight/_form.html.twig';
    }

    /**
     * @Route("/admin/flight",name="admin.flight.index")
     * @return Response
     */
    public function index(): Response {

        $flights = $this->flight_repository->findAll();
        return $this->render('admin/flight/index.html.twig', [
            'flights' => $flights
        ]);
    }

    /**
     * @Route("/admin/flight/create", name="admin.flight.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request):Response {
        $flight = new Flight();
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($flight);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.flight.index');
        }

        return $this->render('admin/new.html.twig', [
            'path' => $this->form_path,
            'type' => 'vol',
            'flight' => $flight,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/flight/{id}", name="admin.flight.edit", methods="GET|POST")
     * @param Flight $flight
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Flight $flight, Request $request) {

        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.flight.index');
        }

        return $this->render('admin/edit.html.twig', [
            'path' => $this->form_path,
            'flight' => $flight,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/flight/{id}", name="admin.flight.delete", methods="DELETE")
     * @param Flight $flight
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Flight $flight, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $flight->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($flight);
            try {
                $em->flush();
                $this->addFlash('success','Supprimé avec succès');
            }
            catch (Exception $e) {
                $this->addFlash('danger',"Vous devez d'abord supprimer tous les départs associés à ce vol");
            }

        }
        return $this->redirectToRoute('admin.flight.index');
    }
}