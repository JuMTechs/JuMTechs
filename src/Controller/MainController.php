<?php

namespace App\Controller;

use App\Repository\EventRegistrationRepository;
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
    public function readAllAction(EventRegistrationRepository $r): Response
    {
        $event = $this->repo->findAll();
        $user = $this->getUser();
        if(isset($user))
        {
            $userid = $user->getID();
            $revent = $r->findEventUserRegis($userid);
            $data = [];
            foreach($revent as $a)
            {
                $data[] = [
                    'name'=>$a['eventName'],
                    'startday'=>$a['eventStartDay'],
                    'endday'=>$a['eventEndDay'],
                    'detail'=>$a['eventDetail'],
                    'img'=>$a['eventImage']
                ];
            }
                // return $this->json($data);
                return $this->render('home.html.twig', [
                    'event' => $data, 'events'=> $event, 
                ]);
        }else{
            return $this->render('home.html.twig', [
                'events'=> $event,
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