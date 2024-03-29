<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TabController extends AbstractController
{
    #[Route('/tab/{nb<\d+>?5}', name: 'app_tab')]
    public function index($nb): Response
    {
        $notes =[];
        for ($i = 0; $i<$nb ; $i++){
            $notes []= rand(0,20);

        }
        return $this->render('tab/index.html.twig', [
            'notes' => $notes,
        ]);
    }
    #[Route('/tab/users', name: 'app_users')]
    public function users(): Response
    {
        $users =[
            ['firstname'=> 'Benjamin',
            'name' => 'DATONDJI',
            'age'  => 26],
            ['firstname' => 'Lucienne',
            'name' => 'AFFO',
            'age' => 24],
            ['firstname' => 'Bruno',
            'name' => 'ALOI',
            'age' => 28]
        ];

        return $this->render('tab/users.html.twig',[
            'users' => $users,
        ]);
    }
    





}
