<?php

namespace App\Controller;

use App\Entity\AccountDetail;
use App\Entity\Event;
use App\Form\AccountDetailType;
use App\Form\EventType;
use App\Repository\AccountDetailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class AccountDetailController extends AbstractController
{
    
    private AccountDetailRepository $repo;
    public function __construct(AccountDetailRepository $repo)
   {
      $this->repo = $repo;
   }
   
    // /**
    //  * @Route("/accountDetailShow", name="accDetailShow")
    //  */
    // public function readAllAction(): Response
    // {
    //     $accountDetail = $this->repo->findAll();
    //     return $this->render('account_detail/index.html.twig', [
    //         'events'=>$accountDetail
    //     ]);
    // }

    //  /**
    //  * @Route("/{id}", name="event_read",requirements={"id"="\d+"})
    //  */
    // public function showAction(Event $e): Response
    // {
    //     return $this->render('event/index.html.twig', [
    //         'e'=>$e
    //     ]);
    // }
    
     /**
     * @Route("/addAccDetail", name="accDetailCreate")
     */
    public function createAction(Request $req, SluggerInterface $slugger): Response
    {
        $e = new AccountDetail();
        $form = $this->createForm(AccountDetailType::class, $e);

        $form->handleRequest($req);

        $user_id = $this -> getUser();

        // $entityManager = $this->getDoctrine()->getManager();
        
        $e->setUser($user_id);

        if($form->isSubmitted() && $form->isValid()){
            if($e->getBirthday()===null){
                $e->setBirthday(new \DateTime());
            }
            $imgFile = $form->get('file')->getData();
            if ($imgFile) {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $e->setImage($newFilename);
            }
            $this->repo->save($e,true);
            return $this->redirectToRoute('accountDetailCreate', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("account_detail/index.html.twig",[
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/AccDetailEdit/{id}", name="AccDetailEdit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, AccountDetail $c, SluggerInterface $slugger): Response
    {
        
        $form = $this->createForm(AccountDetailType::class, $c);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            if($c->getStatus()===null)
            {
                $c->setStatus(new \string());
            }
            if($c->getBirthday()===null)
            {
                $c->setBirthday(new \DateTime());
            }
            $imgFile = $form->get('file')->getData();
            if ($imgFile) 
            {
                $newFilename = $this->uploadImage($imgFile,$slugger);
                $c->setImage($newFilename);
            }
            $this->repo->save($c,true);
            return $this->redirectToRoute('accDetailShow', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("account_detail/index.html.twig",[
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
     * @Route("/AccDetailDelete/{id}",name="AccDetailDelete",requirements={"id"="\d+"})
     */
    
    public function deleteAction(Request $request, AccountDetail $c): Response
    {
        $this->repo->remove($c,true);
        return $this->redirectToRoute('accDetailShow', [], Response::HTTP_SEE_OTHER);
    }

}