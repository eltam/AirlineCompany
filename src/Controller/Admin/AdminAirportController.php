<?php

namespace App\Controller\Admin;

use App\Entity\Airport;
use App\Form\AirportType;
use App\Repository\AirportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAirportController extends AbstractController{

    /**
     * @var AirportRepository
     */
    private $airport_repository;

    /**
     * @var string
     */
    private $form_path;

    /**
     * AdminAirportController constructor.
     * @param AirportRepository $airport_repository
     */
    public function __construct(AirportRepository $airport_repository) {
        $this->airport_repository = $airport_repository;
        $this->form_path = 'admin/airport/_form.html.twig';
    }

    /**
     * @Route("/admin/airport",name="admin.airport.index")
     * @return Response
     */
    public function index(): Response {

        $airports = $this->airport_repository->findAll();
        return $this->render('admin/airport/index.html.twig', [
            'airports' => $airports
        ]);
    }

    /**
     * @Route("/admin/airport/create", name="admin.airport.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request):Response {
        $airport = new Airport();
        $form = $this->createForm(AirportType::class, $airport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($airport);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.airport.index');
        }

        return $this->render('admin/airport/new.html.twig', [
            'path' => $this->form_path,
            'type' => 'aéroport',
            'airport' => $airport,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/airport/{id}", name="admin.airport.edit", methods="GET|POST")
     * @param Airport $airport
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(Airport $airport, Request $request) {

        $form = $this->createForm(AirportType::class, $airport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.airport.index');
        }

        return $this->render('admin/airport/edit.html.twig', [
            'path' => $this->form_path,
            'airport' => $airport,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/airport/{id}", name="admin.airport.delete", methods="DELETE")
     * @param Airport $airport
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Airport $airport, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $airport->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($airport);
            $em->flush();
            $this->addFlash('success','Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.airport.index');
    }
}