<?php

namespace App\Controller\Admin;

use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminClientController extends AbstractController
{

    /**
     * @var ClientRepository
     */
    private $client_repository;

    /**
     * AdminAirportController constructor.
     * @param ClientRepository $client_repository
     */
    public function __construct(ClientRepository $client_repository)
    {
        $this->client_repository = $client_repository;
    }

    /**
     * @Route("/admin/client",name="admin.client.index")
     * @return Response
     */
    public function index(): Response
    {

        $clients = $this->client_repository->findAll();
        return $this->render('admin/client/index.html.twig', [
            'clients' => $clients
        ]);
    }
}