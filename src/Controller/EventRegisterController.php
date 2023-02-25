<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventRegistration;
use App\Form\EventRegisType;
use App\Repository\EventRegistrationRepository;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class EventRegisterController extends AbstractController
{
    private EventRegistrationRepository $repo;
    public function __construct(EventRegistrationRepository $repo)
    {
      $this->repo = $repo;
    }
    /**
     * @Route("/event/register/{id}", name="event_register")
     */
    public function RegisEvent(Request $request, SluggerInterface $slugger, int $id, EventRepository $eventRepo ): Response
    {
        $new = new EventRegistration();
        $form = $this->createForm(EventRegisType::class,$new);
        $form->handleRequest($request);

        $user_id = $this -> getUser();

        $entityManager = $this->getDoctrine()->getManager();
        
        $event = $entityManager->getRepository(Event::class)->find($id);
        $new->setEvent($event); 
        $new->setUser($user_id);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $this->repo->save($new,true);
            return $this->redirectToRoute('homePage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('event_register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/eventRegisShow", name="eveRegisShow")
     */
    public function showRegisEvent(Request $request, SluggerInterface $slugger): Response
    {
        $show = $this -> repo -> findAll();
        return $this->render('event_register/show.html.twig', 
        [
            'show' => $show
        ]);
    }

    /**
     * @Route("/eveRegisEdit/{id}", name="eveRegisEdit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, EventRegistration $eveRegis, SluggerInterface $slugger): Response
    {
        
        $form = $this->createForm(EventRegisType::class, $eveRegis);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            if($eveRegis->getPhonenumber()===null)
            {
                $eveRegis->setPhonenumber(new \string());
            }

            if($eveRegis->getComment()===null)
            {
                $eveRegis->setComment(new \string());
            }
    
            $this->repo->save($eveRegis,true);
            return $this->redirectToRoute('eveRegisShow', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("event_register/index.html.twig",[
            'form' => $form->createView()
        ]);
    }
    /**
    * @Route("/eveRegisDelete/{id}",name="eveRegisDelete",requirements={"id"="\d+"})
    */
    
    public function deleteAction(Request $request, EventRegistration $eveRegis): Response
    {
         $this->repo->remove($eveRegis,true);
        return $this->redirectToRoute('eventRegisShow', [], Response::HTTP_SEE_OTHER);
    }
 
}