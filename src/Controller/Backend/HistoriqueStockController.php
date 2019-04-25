<?php

namespace App\Controller\Backend;

use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\HistoriqueStockRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HistoriqueStockController extends AbstractController
{
   /**
     * @Route("admin/historique/stock", name="backend_historique_stock")
     */
    public function index(HistoriqueStockRepository $historiqueStockRepo, EntityManagerInterface $em, Request $request, PaginatorInterface $paginator)
    {
        $query = $historiqueStockRepo->customHistory();
        $historiqueStock = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
            );
        return $this->render('backend/historique_stock/index.html.twig', [
            'historiqueStock' => $historiqueStock,
        ]);
    }
}
