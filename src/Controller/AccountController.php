<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    private UserRepository $repo;
    public function __construct(UserRepository $repo)
   {
      $this->repo = $repo;
   }

    // /**
    //  * @Route("/admin", name="app_account")
    //  */
    // public function AccountAction(): Response
    // {
    //     $user = $this->getUser();//get logined user 
    //     // $uid = $user->getId();
    //     $accounts = $user->getName();

    //     // return $this->json($uid);
    //     return $this->render('admin.html.twig', [
    //         'accounts' => $accounts,
    //     ]);
    // }

    /**
     * @Route("/accountShow", name="app_account_show")
     */
    public function AccountShowAction(UserRepository $repo): Response
    {
        $account = $repo->findUserAccount('USER');
        $data = [];
        foreach($account as $a){
            $data[] = [
                'id'=>$a['id'],
                'email'=>$a['email']
            ];
        }
        return $this->json($data);
        // return $this->render('account/show.html.twig', [
        //     'account' => $account,
        // ]);
    }

}