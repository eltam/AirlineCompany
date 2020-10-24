<?php

namespace App\Controller\Admin;

use App\Entity\AirCrew;
use App\Entity\Pilot;
use App\Form\AircrewType;
use App\Form\PilotType;
use App\Repository\AirCrewRepository;
use App\Repository\PilotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAirEmployeeController extends AbstractController {

    /**
     * @var PilotRepository
     */
    private $pilot_repository;

    /**
     * @var AirCrewRepository
     */
    private $aircrew_repository;

    /**
     * AdminEmployeeController constructor.
     * @param PilotRepository $pilot_repository
     * @param AirCrewRepository $aircrew_repository
     */
    public function __construct(PilotRepository $pilot_repository, AirCrewRepository $aircrew_repository) {
        $this->pilot_repository = $pilot_repository;
        $this->aircrew_repository = $aircrew_repository;
    }

    /**
     * @Route("/admin/airEmployee",name="admin.airEmployee.index")
     * @return Response
     */
    public function index(): Response {

        $pilots = $this->pilot_repository->findAll();
        $aircrew = $this->aircrew_repository->findAll();
        return $this->render('admin/employee/airEmployee/index.html.twig', [
            'pilots' => $pilots,
            'aircrew' => $aircrew,
        ]);
    }

    /**
     * @Route("/admin/pilot/create", name="admin.pilot.new")
     * @param Request $request
     * @return Response
     */
    public function newPilot(Request $request):Response {
        $pilot = new Pilot();
        $form = $this->createForm(PilotType::class, $pilot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pilot);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.airEmployee.index');
        }

        return $this->render('admin/employee/new.html.twig', [
            'type' => 'pilote',
            'pilot' => $pilot,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/pilot/{id}", name="admin.pilot.edit", methods="GET|POST")
     * @param Pilot $pilot
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editPilot(Pilot $pilot, Request $request) {

        $form = $this->createForm(PilotType::class, $pilot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.airEmployee.index');
        }

        return $this->render('admin/employee/edit.html.twig', [
            'pilot' => $pilot,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/pilot/{id}", name="admin.pilot.delete", methods="DELETE")
     * @param Pilot $pilot
     * @param Request $request
     * @return RedirectResponse
     */
    public function deletePilot(Pilot $pilot, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $pilot->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pilot);
            $em->flush();
            $this->addFlash('success','Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.airEmployee.index');
    }

    /**
     * @Route("/admin/aircrew/create", name="admin.aircrew.new")
     * @param Request $request
     * @return Response
     */
    public function newAircrew(Request $request):Response {
        $aircrew = new AirCrew();
        $form = $this->createForm(AircrewType::class, $aircrew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aircrew);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.airEmployee.index');
        }

        return $this->render('admin/employee/new.html.twig', [
            'type' => 'membre d\'équipage',
            'aircrew' => $aircrew,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/aircrew/{id}", name="admin.aircrew.edit", methods="GET|POST")
     * @param AirCrew $aircrew
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAircrew(AirCrew $aircrew, Request $request) {

        $form = $this->createForm(AircrewType::class, $aircrew);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.airEmployee.index');
        }

        return $this->render('admin/employee/edit.html.twig', [
            'aircrew' => $aircrew,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aircrew/{id}", name="admin.aircrew.delete", methods="DELETE")
     * @param AirCrew $aircrew
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteAircrew(AirCrew $aircrew, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $aircrew->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aircrew);
            $em->flush();
            $this->addFlash('success','Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.airEmployee.index');
    }

}