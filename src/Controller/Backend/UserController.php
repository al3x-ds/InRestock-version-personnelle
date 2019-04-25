<?php

namespace App\Controller\Backend;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
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
            return $this->redirectToRoute('backend_user_index');
        }

        return $this->render('backend/user/index.html.twig', [
            'users' => $users,
            "form" => $form->createView()
        ]);
    }
   
}
