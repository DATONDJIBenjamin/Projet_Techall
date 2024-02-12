<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// Préfixe d'une route    
#[Route('/todo')]
class TodoController extends AbstractController
{
    #[Route(name: 'app_todo')]
    public function index(Request $request): Response
     {
        $session = $request->getSession();
        //Afficher mon tableau de todo
        if(!$session->has('todos')){
            $todos = [
                'achat' => 'Acheter clé usb',
                'cours' => 'Finaliser mon cours',
                'correction' => 'Corriger mes examens'
            ];
            $session->set('todos',$todos);
            $this->addFlash('info',"La liste des todos vient d'etre initialisé");
          
            //Si j'ai mon tableau de todo,je ne fais que l'afficher
   }
        return $this->render('todo/index.html.twig');
    }

    // Ajout d'un élément dans mon tableau
    
    #[Route('/add/{name?Mardi}/{content?Jouer}', name: 'app_add')]
    public function addtodo(Request $request, $name , $content): Response
    {
        $session = $request->getSession();
        //Afficher mon tableau de todo
        if($session->has('todos')){
            $todos=$session->get('todos');
            if(isset($todos[$name])){
                $this->addFlash('error',"Le todo d'id $name existe deja");
            }else{
                $todos[$name] = $content;
                $this->addFlash('success',"Le todo d'id $name a été ajouté avec succès");
                $session->set('todos',$todos);
            }

            
          
            //Si j'ai mon tableau de todo,je ne fais que l'afficher
   }else{
$this->addFlash('info',"La liste des todo n'est pas encore initialisée");
   }
        return $this->redirectToRoute('app_todo');
    }
    
// Code pour la modification du contenu de notre tableau todo

#[Route('/update/{name}/{content}', name: 'app_update')]
public function updatetodo(Request $request, $name , $content): Response
{
    $session = $request->getSession();
    //Afficher mon tableau de todo
    if($session->has('todos')){
        $todos=$session->get('todos');
        if(!isset($todos[$name])){
            $this->addFlash('error',"Le todo d'id $name n'existe pas dans la liste");
        }else{
            $todos[$name] = $content;
            $this->addFlash('success',"Le todo d'id $name a été modifié avec succès");
            $session->set('todos',$todos);
        }
          //Si j'ai mon tableau de todo,je ne fais que l'afficher
}else{
$this->addFlash('info',"La liste des todo n'est pas encore initialisée");
}
    return $this->redirectToRoute('app_todo');
}

//Code pour la suppression d'un élément de todo

#[Route('/delete/{name}}', name: 'app_delete')]
public function deletetodo(Request $request, $name): Response
{
    $session = $request->getSession();
    //Afficher mon tableau de todo
    if($session->has('todos')){
        $todos=$session->get('todos');
        if(!isset($todos[$name])){
            $this->addFlash('error',"Le todo d'id $name n'existe pas dans la liste");
        }else{
            unset($todos[$name]);
            $this->addFlash('success',"Le todo d'id $name a été supprimé avec succès");
            $session->set('todos',$todos);
        }

        
      
        //Si j'ai mon tableau de todo,je ne fais que l'afficher
}else{
$this->addFlash('info',"La liste des todo n'est pas encore initialisée");
}
    return $this->redirectToRoute('app_todo');
}

// Code pour remettre à niveau(Tout supprimer) notre tableau todo

#[Route('/reset', name: 'app_reset')]
public function resettodo(Request $request): Response
{
    $session = $request->getSession();
   $session->remove('todos');
    return $this->redirectToRoute('app_todo');
}





    
}
