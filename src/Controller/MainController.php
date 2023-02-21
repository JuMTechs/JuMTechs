<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homePage")
     */
    public function homePageAction(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/admin", name="adminPage")
     */
    public function adminPageAction(): Response
    {
        return $this->render('admin.html.twig');
    }
}