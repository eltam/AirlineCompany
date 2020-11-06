<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUserController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $user_repository;

    /**
     * AdminAirportController constructor.
     * @param UserRepository $user_repository
     */
    public function __construct(UserRepository $user_repository)
    {
        $this->user_repository = $user_repository;
    }

    /**
     * @Route("/admin/user",name="admin.user.index")
     * @return Response
     */
    public function index(): Response
    {

        $users = $this->user_repository->findAll();
        return $this->render('admin/user/index.html.twig', [
            'users' => $users
        ]);
    }
}