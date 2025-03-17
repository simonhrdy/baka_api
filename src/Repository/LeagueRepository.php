<?php

namespace App\Repository;

use App\Entity\League;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<League>
 */
class LeagueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, League::class);
    }

    public function findBySport(string $sport)
    {
        return $this->createQueryBuilder('g')
            ->join('g.sport', 's')
            ->andWhere('s.url = :sport')
            ->setParameter('sport', $sport)
            ->getQuery()
            ->getResult();
    }

    public function findTeamsWithGamesByLeagueId(int $leagueId)
    {
        return $this->createQueryBuilder('l')
            ->leftJoin('l.seasons', 's')
            ->leftJoin('s.teams', 't')
            ->leftJoin('t.games_home', 'gh')
            ->leftJoin('t.games_away', 'ga')
            ->addSelect('s', 't', 'gh', 'ga')
            ->where('l.id = :leagueId')
            ->setParameter('leagueId', $leagueId)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return League[] Returns an array of League objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?League
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
