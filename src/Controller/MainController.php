<?php

namespace App\Controller;

use App\Repository\EventRepository;
use App\Repository\UserRepository;
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
        $user = $this->getUser();
            if( isset($user) )
            {

                return $this->render('home.html.twig', [
                    'events'=>$event
                ]);
            }
            else
            {
                return $this->render('home.html.twig', [
                    'events'=>$event 
                ]);
            }
    }
    /**
     * @Route("/admin", name="adminPage")
     */
    public function adminPageAction(): Response
    { 
        $user = $this->getUser();
            return $this->render('admin.html.twig', [
                'user'=>$user
            ]);
    }
}