<?php

namespace App\Controller;

use App\Entity\EventRegistration;
use App\Form\EventRegisType;
use App\Repository\EventRegistrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/event")
 */

class EventRegisterController extends AbstractController
{
    private EventRegistrationRepository $repo;
    public function __construct(EventRegistrationRepository $repo)
    {
      $this->repo = $repo;
    }
    
    #[Route('/register', name: 'event_register')]
    public function RegisEvent(Request $request): Response
    {
        $new = new EventRegistration();
        $form = $this->createForm(EventRegisType::class,$new);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->repo->save($new,true);
            return $this->redirectToRoute('homePage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('event_register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}