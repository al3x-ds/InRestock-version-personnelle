<?php
namespace App\Controller\Api;

use PhpParser\JsonDecoder;
use App\Entity\HistoriqueStock;
use App\Repository\UserRepository;
use App\Repository\StockRepository;
use App\Repository\ProductRepository;
use App\Repository\ModificationRepository;
use JMS\SerializerBundle\JMSSerializerBundle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
/**
    * @Route("/api", name="api_")
 */
class ModificationController extends AbstractController
{
    /**
     * @Route("/history/add", name="historique", methods={"POST"})
     */
    public function line(Request $request, ProductRepository $productRepo, UserRepository $userRepo)
    {
        // On recupere l'integralité de la request et on la stocke
       $data = $request->getContent();
       
       // On utilise la fonction native de chez php : json_decode pour décoder le json
       $req = json_decode($data);
       
       // On récupère l'id de l'user courant
       $userId = $req->user;
       
       // On récupère le user associé à l'id du user courant
       $user = $userRepo->findById($userId);
       $userToSet = $user[0]->getName();
       
       $variation = $req->variation;
       
       // On récupère le stock associé au produit que l'on doit modifier :
        $product = $req->product;
        $productOne = $productRepo->findById($product);
        $productToSet = $productOne[0]->getName(); 
        $stock = $productOne[0]->getStock();   
        //On récupère le stock courant
        $currentStock = $productOne[0]->getStock()->getStock();       
        // On lui ajoute la variation
        $newStock = $currentStock + $variation;
        
        //! Si la somme/soustraction du stock rentrée par l'utilisateur passe sous 0 alors on stoppe tout et on retourne un message d'erreur
        if ($newStock < 0){
            return $this->json(['stock' => 'Il n\'est pas possible d\'avoir un stock inférieur à 0']);
        }
        // on set le newStock et on le push en bdd
        $stock->setStock($newStock);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($stock);
        ///ensuite on crée une nouvelle ligne HistoriqueStock et on la remplit avec les données récupérées plus haut
        $newLine = new HistoriqueStock();
        $newLine->setVariation($variation);
        $newLine->setProduct($productToSet);
        $newLine->setUser($userToSet);
        $newLine->setNewStock($newStock);
        $newLine->setCreatedAt(new \DateTime());
        $entityManager->persist($newLine);
        $entityManager->flush();
        return $this->json(['stock' => $newStock], 200);
    }
    
}
