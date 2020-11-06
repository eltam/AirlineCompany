<?php

namespace App\Controller;


use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @var string
     */
    private $form_path;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * TicketController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository) {
        $this->form_path = 'pages/user/_form.html.twig';
        $this->repository = $repository;

    }

    /**
     * @Route("/user/create", name="user.new")
     * @param Request $request
     * @return RedirectResponse
     */
    public function new(Request $request): RedirectResponse
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
    }
}