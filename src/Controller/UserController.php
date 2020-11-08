<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * TicketController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $passwordEncoder) {
        $this->form_path = 'pages/user/_form.html.twig';
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;


    }

    /**
     * @Route("/user/create", name="user.new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request):Response {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            # Hash password
            $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('app_login');
        }

        return $this->render('pages/user/new.html.twig', [
            'path' => $this->form_path,
            'user' => $user,
            'form' => $form->createView()
        ]);

    }
}