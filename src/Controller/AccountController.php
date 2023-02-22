<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    // #[Route('/account', name: 'app_account')]
    // public function index(): Response
    // {
    //     return $this->render('account/index.html.twig', [
    //         'controller_name' => 'AccountController',
    //     ]);
    // }

    private UserRepository $repo;
    public function __construct(UserRepository $repo)
   {
      $this->repo = $repo;
   }

    /**
     * @Route("/account", name="app_account")
     */
    public function AccountAction(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/account_show", name="app_account_show")
     */
    public function AccountShowAction(): Response
    {
        $account = $this->repo->findAll();
        return $this->render('account/show.html.twig', [
            'account' => $account,
        ]);
    }

}