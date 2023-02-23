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
/**
 * @Route("/event/register")
 */
class EventRegisterController extends AbstractController
{
    private EventRegistrationRepository $repo;
    private EventRepository $re;
    public function __construct(EventRegistrationRepository $repo,EventRepository $re)
    {
      $this->repo = $repo;
      $this->re = $re;
    }
    #[Route('/{id}', name: 'app_event_register')]
    public function RegisEvent(Request $request, SluggerInterface $slugger,Event $event): Response
    {
        
        $user = $this->getUser();//get logined user 
        // $uid = $user->getId();
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

    /**
     * @Route("/show", name="event_regis_show")
     */
    public function readAllAction(): Response
    {
        $event = $this->re->findAll();

        $user = $this->getUser();//get logined user 
        $uid = $user->getId();
        $uname = $user->getname();
        
        return $this->render('event_register/show.html.twig', [
            'eve'=>$event,
            'uid'=>$uid,
            'uname'=>$uname
        ]);
    }

    //  /**
    //  * @Route("/delete/{id}",name="event_delete",requirements={"id"="\d+"})
    //  */
    
    //  public function deleteAction(Request $request, Event $c): Response
    //  {
    //      $this->repo->remove($c,true);
    //      return $this->redirectToRoute('event_show', [], Response::HTTP_SEE_OTHER);
    //  }
}
