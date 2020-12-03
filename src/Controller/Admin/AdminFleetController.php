<?php

namespace App\Controller\Admin;

use App\Entity\Aircraft;
use App\Entity\AircraftModel;
use App\Form\AircraftModelType;
use App\Form\AircraftType;
use App\Repository\AircraftModelRepository;
use App\Repository\AircraftRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFleetController extends AbstractController {

    /**
     * @var AircraftModelRepository
     */
    private $aircraft_model_repository;

    /**
     * @var AircraftRepository
     */
    private $aircraft_repository;

    /**
     * @var string
     */
    private $model_form_path;

    /**
     * @var string
     */
    private $aircraft_form_path;

    /**
     * AdminFleetController constructor.
     * @param AircraftModelRepository $aircraft_model_repository
     * @param AircraftRepository $aircraft_repository
     */
    public function __construct(AircraftModelRepository $aircraft_model_repository, AircraftRepository $aircraft_repository) {
        $this->aircraft_model_repository = $aircraft_model_repository;
        $this->aircraft_repository = $aircraft_repository;
        $this->model_form_path = 'admin/fleet/aircraft_model/_form.html.twig';
        $this->aircraft_form_path = 'admin/fleet/aircraft/_form.html.twig';
    }

    /**
     * @Route("/admin/fleet",name="admin.fleet.index")
     * @return Response
     */
    public function index(): Response {

        $aircraft_models = $this->aircraft_model_repository->findAll();
        $aircrafts = $this->aircraft_repository->findAll();
        return $this->render('admin/fleet/index.html.twig', [
            'aircraft_models' => $aircraft_models,
            'aircrafts' => $aircrafts,
        ]);
    }

    /**
     * @Route("/admin/aircraft_model/create", name="admin.aircraft_model.new")
     * @param Request $request
     * @return Response
     */
    public function newAircraftModel(Request $request):Response {
        $aircraft_model = new AircraftModel();
        $form = $this->createForm(AircraftModelType::class, $aircraft_model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aircraft_model);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.fleet.index');
        }

        return $this->render('admin/new.html.twig', [
            'path' => $this->model_form_path,
            'type' => 'modèle',
            'aircraft_model' => $aircraft_model,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aircraft_model/{id}", name="admin.aircraft_model.edit", methods="GET|POST")
     * @param AircraftModel $aircraft_model
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAircraftModel(AircraftModel $aircraft_model, Request $request) {

        $form = $this->createForm(AircraftModelType::class, $aircraft_model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.fleet.index');
        }

        return $this->render('admin/edit.html.twig', [
            'path' => $this->model_form_path,
            'aircraft_model' => $aircraft_model,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aircraft_model/{id}", name="admin.aircraft_model.delete", methods="DELETE")
     * @param AircraftModel $aircraft_model
     * @param Request $request
     * @return RedirectResponse
     */
    public function deleteAircraftModel(AircraftModel $aircraft_model, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $aircraft_model->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aircraft_model);
            try {
                $em->flush();
                $this->addFlash('success','Supprimé avec succès');
            }
            catch (Exception $e) {
                $this->addFlash('danger',"Vous ne pouvez pas supprimer ce modèle car il définit des appareils de la flotte");
            }
        }
        return $this->redirectToRoute('admin.fleet.index');
    }

    /**
     * @Route("/admin/aircraft/create", name="admin.aircraft.new")
     * @param Request $request
     * @return Response
     */
    public function newAircraft(Request $request):Response {
        $aircraft = new Aircraft();
        $form = $this->createForm(AircraftType::class, $aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($aircraft);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.fleet.index');
        }

        return $this->render('admin/new.html.twig', [
            'path' => $this->aircraft_form_path,
            'type' => 'appareil',
            'aircraft' => $aircraft,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aircraft/{id}", name="admin.aircraft.edit", methods="GET|POST")
     * @param Aircraft $aircraft
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editPilot(Aircraft $aircraft, Request $request) {

        $form = $this->createForm(AircraftType::class, $aircraft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.fleet.index');
        }

        return $this->render('admin/edit.html.twig', [
            'path' => $this->aircraft_form_path,
            'aircraft' => $aircraft,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/aircraft/{id}", name="admin.aircraft.delete", methods="DELETE")
     * @param Aircraft $aircraft
     * @param Request $request
     * @return RedirectResponse
     */
    public function deletePilot(Aircraft $aircraft, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $aircraft->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($aircraft);
            try {
                $em->flush();
                $this->addFlash('success','Supprimé avec succès');
            }
            catch (Exception $e) {
                $this->addFlash('danger',"Vous ne pouvez pas supprimer cet appareil car il assure des vols prévus");
            }
        }
        return $this->redirectToRoute('admin.fleet.index');
    }
}