<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * @Route("/account")
 */
class AccountController extends AbstractController
{

    private UserRepository $repo;
    public function __construct(UserRepository $repo)
   {
      $this->repo = $repo;
   }

    /**
     * @Route("/", name="app_account")
     */
    public function AccountAction(): Response
    {
        $user = $this->getUser();//get logined user 
        // $uid = $user->getId();
        $userId = $user->getId();
        $userName = $user->getName();
        $userEmail = $user->getEmail();

        // return $this->json($uid);
        return $this->render('account/index.html.twig', [
            'userId' => $userId,
            'userName' => $userName,
            'userEmail' => $userEmail
        ]);
    }

    /**
     * @Route("/accountShow", name="app_account_show")
     */
    public function AccountShowAction(UserRepository $repo): Response
    {
        $user = $this->getUser();//get logined user 
        $userName = $user->getName();
        $account = $repo->findUserAccount('USER');
        $data = [];
        foreach($account as $a){
            $data[] = [
                'id'=>$a['id'],
                'email'=>$a['email'],
                'name'=>$a['name']
            ];
        }
        // return $this->json($data);
        return $this->render('account/show.html.twig', [
            'account' => $data,
            'name' => $userName 
        ]);
    }

     /**
     * @Route("/edit/{id}", name="account_edit",requirements={"id"="\d+"})
     */
    public function editAction(Request $req, User $c,SluggerInterface $slugger, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $user = $this -> getUser();
        $form = $this->createForm(UserType::class, $c);   

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){

            if($c->getEmail()===null)
            {
                $c->setEmail(new \string());
            }
            if($c->getName()===null)
            {
                $c->setName(new \string());
            }
            
            if($c->getPassword()===null)
            {
                $c->setPassword(new \string());
            }
            $this->repo->save($c,true);
            return $this->redirectToRoute('app_account_show', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render("account/form.html.twig",[
            'form' => $form->createView()
        ]);
    }

    // public function uploadImage($imgFile, SluggerInterface $slugger): ?string{
    //     $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
    //     $safeFilename = $slugger->slug($originalFilename);
    //     $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();
    //     try {
    //         $imgFile->move(
    //             $this->getParameter('image_dir'),
    //             $newFilename
    //         );
    //     } catch (FileException $e) {
    //         echo $e;
    //     }
    //     return $newFilename;

    /**
     * @Route("/delete/{id}",name="account_delete",requirements={"id"="\d+"})
     */
    
    public function deleteAction(Request $request, User $c): Response
    {
        $this->repo->remove($c,true);
        return $this->redirectToRoute('app_account_show', [], Response::HTTP_SEE_OTHER);
    }

    
}