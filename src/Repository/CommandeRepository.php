<?php

namespace App\Repository;

use App\Entity\Commande;
use App\Entity\FiltreCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * @method Commande|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commande|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commande[]    findAll()
 * @method Commande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandeRepository extends ServiceEntityRepository
{
    /**
     * @var PaginatorInterface
     */
    private $paginator;
    
    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Commande::class);

        $this->paginator = $paginator;
    }

    // /**
    //  * @return Commande[] Returns an array of Commande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Commande
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    /**
     * Recupère les commandes en lien avec une recherche
     * @return PaginationInterface
     */
    public function findSearch(FiltreCommande $search): PaginationInterface
    {
        $query = $this->getSearcheQuery($search)->getQuery();

        return $this->paginator->paginate(
            $query,
            $search->page,
            20
        );
    }

    /**
     * //@return QueryBuilder
     */
    private function getSearcheQuery(FiltreCommande $search) //: QueryBuilder
    {
        $query = $this->createQueryBuilder('c')
            ->select('v', 'c')
            ->select('cli', 'c')
            ->select('i', 'c')
            ->join('c.vehicule', 'v')
            ->leftjoin('c.client', 'cli')
            ->leftjoin('c.itineraires', 'i')
            ->orderBy('c.created', 'DESC');

        if ($search->getVehicules()->count() > 0) {
            $query = $query
                ->andWhere('v.id IN (:vehicule)')
                ->setParameter('vehicule', $search->vehicules);
        }

        if ($search->getClients()->count() > 0) {
            $query = $query
                ->andWhere('cli.id IN (:client)')
                ->setParameter('client', $search->clients);
        }

        if ($search->getItineraires()->count() > 0) {
            $query = $query
                ->andWhere('i.id IN (:itineraires)')
                ->setParameter('itineraires', $search->itineraires);
        }

        if (!empty($search->statut)) {
            $query = $query
                ->andWhere('c.statut = 1');
        }

        if (!empty($search->dateReception)) {
            $query = $query
                ->andWhere('c.dateReception = :dateReception')
                ->setParameter('dateReception', $search->dateReception);;
        }

        if (!empty($search->dateLivraison)) {
            $query = $query
                ->andWhere('c.dateLivraison = :dateLivraison')
                ->setParameter('dateLivraison', $search->dateLivraison);;
        }

        return $query;
    }
}