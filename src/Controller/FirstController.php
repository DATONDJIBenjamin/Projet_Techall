<?php

namespace App\Controller;

use PhpParser\Node\Name;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {
        return $this->render('first/index.html.twig',[
            'name' => 'Lucienne',
            'firstname' => 'Benjamin'
        ]);
       
    }

    #[Route('/SayHello', name: 'app_hello')]
    public function SayHello(): Response
    {
        
        $rand =rand(0 , 10);
        echo $rand;
        if($rand ==3){
         return $this->redirectToRoute('app_first');
        }
        return $this->render('first/hello.html.twig',[
            'name' => 'Lucienne',
            'firstname' => 'Benjamin'
        ]);
       
    }

   // #[Route('/SayHello1/{name}/{firstname}', name: 'app_hello1')]
    public function SayHello1(Request $request, $name,$firstname): Response
    {
       
        return $this->render('first/hello1.html.twig',[
            'nom'=> $name,
            'prenom'=>$firstname,
          //  'path' => '    '
        ]);
       
    }

    #[Route('multi/{entier1<\d+>}/{entier2<\d+>}', name:'app_multi')]
    public function Multiplication($entier1,$entier2){
        $resultat = $entier1*$entier2;
        return new Response("<h1>$resultat</h1>");
    }

    #[Route('/template', name: 'app_template')]
    public function template(): Response
    {
        return $this->render('Template.html.twig');
       
    }

}

