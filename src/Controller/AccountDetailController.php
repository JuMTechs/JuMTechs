<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountDetailController extends AbstractController
{
    #[Route('/account/detail', name: 'app_account_detail')]
    public function index(): Response
    {
        return $this->render('account_detail/index.html.twig', [
            'controller_name' => 'AccountDetailController',
        ]);
    }
}
