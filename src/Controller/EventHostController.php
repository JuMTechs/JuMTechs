<?php

namespace App\Controller;

use App\Entity\EventHostInfo;
use App\Form\HostType;
use App\Repository\EventHostInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/event/host')]

class EventHostController extends AbstractController
{
        
    private EventHostInfoRepository $repo;
    public function __construct(EventHostInfoRepository $repo)
   {
      $this->repo = $repo;
   }

    /**
     * @Route("/", name="host_show")
     */
    public function readAllAction(): Response
    {
        $host = $this->repo->findAll();
        return $this->render('host/show.html.twig', [
            'host'=>$host
        ]);
    }

    /**
     * @Route("/add", name="add_host")
     */
    public function createAction(Request $req, SluggerInterface $slugger): Response
    {
        $e = new EventHostInfo();
        $form = $this->createForm(HostType::class, $e);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $e->setImage($newFilename);
            }
            $this->repo->save($e,true);
            return $this->redirectToRoute('host_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("host/index.html.twig",[
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
     * @Route("/edit/{id}", name="host_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, EventHostInfo $c, SluggerInterface $slugger): Response
    {
        
        $form = $this->createForm(HostType::class, $c);

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $c->setImage($newFilename);
            }
            $this->repo->save($c,true);
            return $this->redirectToRoute('adminPage', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("host/index.html.twig",[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/delete/{id}",name="event_delete",requirements={"id"="\d+"})
     */
    
     public function deleteAction(Request $request, EventHostInfo $c): Response
     {
         $this->repo->remove($c,true);
         return $this->redirectToRoute('host_show', [], Response::HTTP_SEE_OTHER);
     }
}
