<?php

namespace App\Controller\Admin;

use App\Entity\Pilot;
use App\Form\PilotType;
use App\Repository\PilotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEmployeeController extends AbstractController {

    /**
     * @var
     */
    private $pilot_repository;

    /**
     * AdminEmployeeController constructor.
     * @param PilotRepository $pilot_repository
     */
    public function __construct(PilotRepository $pilot_repository) {
        $this->pilot_repository = $pilot_repository;
    }

    /**
     * @Route("/admin",name="admin.employee.index")
     * @return Response
     */
    public function index(): Response {

        $pilots = $this->pilot_repository->findAll();
        return $this->render('admin/employee/index.html.twig', compact('pilots'));
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
            return $this->redirectToRoute('admin.employee.index');
        }

        return $this->render('admin/employee/pilot/new.html.twig', [
            'property' => $pilot,
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
            return $this->redirectToRoute('admin.employee.index');
        }

        return $this->render('admin/employee/pilot/edit.html.twig', [
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
        return $this->redirectToRoute('admin.employee.index');
    }

}