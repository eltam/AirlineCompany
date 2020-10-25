<?php

namespace App\Controller\Admin;

use App\Entity\GroundEmployee;
use App\Form\GroundEmployeeType;
use App\Repository\GroundEmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminGroundEmployeeController extends AbstractController {

    /**
     * @var GroundEmployeeRepository
     */
    private $groundEmployeeRepository;

    /**
     * @var string
     */
    private $form_path;

    /**
     * AdminGroundEmployeeController constructor.
     * @param GroundEmployeeRepository $groundEmployeeRepository
     */
    public function __construct(GroundEmployeeRepository $groundEmployeeRepository) {
        $this->groundEmployeeRepository = $groundEmployeeRepository;
        $this->form_path = 'admin/employee/_form.html.twig';
    }

    /**
     * @Route("/admin/groundEmployee",name="admin.groundEmployee.index")
     * @return Response
     */
    public function index(): Response {

        $ground_employees = $this->groundEmployeeRepository->findAll();
        return $this->render('admin/employee/groundEmployee/index.html.twig', [
            'ground_employees' => $ground_employees
        ]);
    }

    /**
     * @Route("/admin/groundEmployee/create", name="admin.groundEmployee.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request):Response {
        $ground_employee = new GroundEmployee();
        $form = $this->createForm(GroundEmployeeType::class, $ground_employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ground_employee);
            $em->flush();
            $this->addFlash('success','Créé avec succès');
            return $this->redirectToRoute('admin.groundEmployee.index');
        }

        return $this->render('admin/new.html.twig', [
            'path' => $this->form_path,
            'type' => 'employé',
            'groundEmployee' => $ground_employee,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/groundEmployee/{id}", name="admin.groundEmployee.edit", methods="GET|POST")
     * @param GroundEmployee $ground_employee
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function edit(GroundEmployee $ground_employee, Request $request) {

        $form = $this->createForm(GroundEmployeeType::class, $ground_employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success','Modifié avec succès');
            return $this->redirectToRoute('admin.groundEmployee.index');
        }

        return $this->render('admin/edit.html.twig', [
            'path' => $this->form_path,
            'groundEmployee' => $ground_employee,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/groundEmployee/{id}", name="admin.groundEmployee.delete", methods="DELETE")
     * @param GroundEmployee $ground_employee
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(GroundEmployee $ground_employee, Request $request) {
        if ($this->isCsrfTokenValid('delete' . $ground_employee->getId(), $request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ground_employee);
            $em->flush();
            $this->addFlash('success','Supprimé avec succès');
        }
        return $this->redirectToRoute('admin.groundEmployee.index');
    }
}