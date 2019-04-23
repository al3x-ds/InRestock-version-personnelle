<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product")
     */
    public function index(ProductRepository $productRepo)
    {
        // Liste des produits
        $products = $productRepo->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/products/{slug}", name="product_show")
     */
    public function show(Product $product){
        
        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}
