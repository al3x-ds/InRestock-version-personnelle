<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
* @Route("/admin", name="backend_")
*/
class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user_index", methods={"GET","POST"})
     */
    public function index(UserRepository $uRepo, UserPasswordEncoderInterface $encoder, Request $request)
    {
        $users = $uRepo->findAll();

        $newUser = new User();
       
        $form = $this->createForm(UserType::class, $newUser);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $hash = $encoder->encodePassword($newUser, $newUser->getPassword());
            $newUser->setPassword($hash);
            $entityManager->persist($newUser);
            $entityManager->flush();
            $this->addFlash('success', 'L\'utilisateur '.$newUser->getName().' a été crée. ');

            return $this->redirectToRoute('backend_user_index');
        }

        return $this->render('backend/user/index.html.twig', [
            'users' => $users,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit")
     */
    public function edit(Request $request, User $user, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder){
        $form = $this->createForm(UserType::class, $user);
        $oldPassword = $user->getPassword();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()){
            if(empty($user->getPassword()) || is_null($user->getPassword())){
                $encodedPassword = $oldPassword;
            } else { 
            $encodedPassword = $encoder->encodePassword($user, $user->getPassword());
        }
        
        $user->setPassword($encodedPassword);    
        $em->persist($user);
        $em->flush();
        $this->addFlash('success', 'L\'utilisateur '.$user->getName().' a été modifier. ');
        return $this->redirectToRoute('backend_user_index');
        }
 
        return $this->render('backend/user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

     /**
     * @Route("user/{id}/delete/", name="user_delete")
     */
    public function delete(Request $request, User $user)
    {
        // delete de l'user choisi
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $this->addFlash('danger', 'L\'utilisateur '.$user->getName().' a été supprimer. ');

        $entityManager->flush();
            
       return $this->redirectToRoute('backend_user_index');
    }
   
}
