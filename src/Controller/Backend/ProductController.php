<?php

namespace App\Controller\Backend;

use App\Entity\Stock;
use App\Entity\Product;
use App\Form\StockType;
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
    public function productIndex(ProductRepository $pRepo, Request $request, EntityManagerInterface $em)
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

    /**
     * @Route("/{slug}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('backend_product_index', [

            ]);
        }
        return $this->render('backend/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

      /**
     * @Route("/{id}/remove", name="product_delete", requirements={"id"="\d+"} )
     */
    public function delete(Request $request, Product $product)
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
            
        return $this->redirectToRoute('backend_product_index');
    }

    

    /**
     * @Route("/{slug}/new-stock", name="product_stock")
     */
    public function newStock(Product $product, Request $request) {
        
        $stock = new Stock();
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $stock->setProduct($product);
            $entityManager->persist($stock);
            $entityManager->flush();
            
            return $this->redirectToRoute('backend_product_index', [
            ]);
        }
        return $this->render('backend/product/new_stock.html.twig', [
            'stock' => $stock,
            'product' => $product,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/{id}/stock-edit", name="stock_edit", methods={"GET","POST"})
     */
    public function stockEdit(Request $request, Stock $stock)
    {
        $form = $this->createForm(StockType::class, $stock);
        $form->handleRequest($request);
        $product = $stock->getProduct();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            $productId = $stock->getProduct()->getId();
            return $this->redirectToRoute('backend_product_index', [

            ]);
        }
        return $this->render('backend/product/edit_stock.html.twig', [
            'stock' => $stock,
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/delete", name="stock_delete", requirements={"id"="\d+"})
     */
    public function stockDelete(Request $request, Stock $stock)
    {
        if ($this->isCsrfTokenValid('delete'.$stock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($stock);
            $entityManager->flush();
        }
        $productId = $stock->getProduct()->getId();
        return $this->redirectToRoute('backend_product_index', [
        ]);
    }

}
