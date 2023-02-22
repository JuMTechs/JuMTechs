<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private EventRepository $repo;
    public function __construct(EventRepository $repo)
    {
      $this->repo = $repo;
    }
    /**
     * @Route("/", name="homePage")
     */
    public function readAllAction(): Response
    {
        $event = $this->repo->findAll();
        return $this->render('home.html.twig', [
            'events'=>$event
        ]);
    }
    // /**
    //  * @Route("/", name="homePage")
    //  */
    // public function homePageAction(): Response
    // {
    //     return $this->render('home.html.twig');
    // }

    /**
     * @Route("/admin", name="adminPage")
     */
    public function adminPageAction(): Response
    {
        return $this->render('admin.html.twig');
    }
}