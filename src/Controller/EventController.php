<?php

namespace App\Controller;

use App\Entity\CalendarManagement;
use App\Form\EventType;
use App\Repository\CalendarManagementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
    * @Route("/event")
*/
class EventController extends AbstractController
{
    
    private CalendarManagementRepository $repo;
    public function __construct(CalendarManagementRepository $repo)
   {
      $this->repo = $repo;
   }

    /**
     * @Route("/", name="event_show")
     */
    public function readAllAction(): Response
    {
        $event = $this->repo->findAll();
        return $this->render('event/index.html.twig', [
            'events'=>$event
        ]);
    }

     /**
     * @Route("/{id}", name="event_read",requirements={"id"="\d+"})
     */
    public function showAction(CalendarManagement $e): Response
    {
        return $this->render('detail.html.twig', [
            'e'=>$e
        ]);
    }

     /**
     * @Route("/add", name="event_create")
     */
    public function createAction(Request $req, SluggerInterface $slugger): Response
    {
        
        $e = new CalendarManagement();
        $form = $this->createForm(EventType::class, $e);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            if($e->getCreated()===null){
                $e->setCreated(new \DateTime());
            }
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $e->setEveImg($newFilename);
            }
            $this->repo->save($e,true);
            return $this->redirectToRoute('event_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("event/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/edit/{id}", name="event_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, CalendarManagement $c,
    SluggerInterface $slugger): Response
    {
        
        $form = $this->createForm(EventType::class, $c);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            if($c->getCreated()===null){
                $c->setCreated(new \DateTime());
            }
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $c->setEveImg($newFilename);
            }
            $this->repo->save($c,true);
            return $this->redirectToRoute('event_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("event/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

    public function uploadImage($imgFile, SluggerInterface $slugger): ?string{
        $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
        try {
            $imgFile->move(
                $this->getParameter('image_dir'),
                $newFilename
            );
        } catch (FileException $e) {
            echo $e;
        }
        return $newFilename;
    }

    /**
     * @Route("/delete/{id}",name="event_delete",requirements={"id"="\d+"})
     */
    
    public function deleteAction(Request $request, CalendarManagement $c): Response
    {
        $this->repo->remove($c,true);
        return $this->redirectToRoute('event_show', [], Response::HTTP_SEE_OTHER);
    }

    
}