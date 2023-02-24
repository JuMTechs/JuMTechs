<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/show", name="app_account_show")
     */
    public function AccountShowAction(UserRepository $repo): Response
    {
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
        ]);
    }

}