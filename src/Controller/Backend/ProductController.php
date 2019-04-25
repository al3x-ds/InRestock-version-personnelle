<?php

namespace App\Controller\Backend;

use App\Entity\Stock;
use App\Entity\Product;
use App\Form\ProductType;
use Cocur\Slugify\Slugify;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/admin", name="backend_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product_index")
     */
    public function index(ProductRepository $pRepo, Request $request, EntityManagerInterface $em)
    {
        $products = $pRepo->findAll();
        $newProduct = new Product();
        $form = $this->createForm(ProductType::class, $newProduct); 

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $preSlug = $newProduct->getName();
            $slugify = new Slugify();
            $newSlug = $slugify->slugify($preSlug);
            $newProduct->setSlug($newSlug);
        
            $em->persist($newProduct);
            $em->flush();
            return $this->redirectToRoute('backend_product_index');
        }


        return $this->render('backend/product/index.html.twig', [
            "products" => $products,
            "form" => $form->createView()
        ]);
    }



}
