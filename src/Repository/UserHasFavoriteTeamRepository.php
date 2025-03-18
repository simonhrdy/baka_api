<?php

namespace App\Repository;

use App\Entity\UserHasFavoriteTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserHasFavoriteTeam>
 */
class UserHasFavoriteTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserHasFavoriteTeam::class);
    }

    public function findFavoritesBySport(int $userId, string $sportUrl): array
    {
        return $this->createQueryBuilder('uht')
            ->join('uht.team_id', 't')
            ->join('t.seasonHasTeams', 'sht')
            ->join('sht.season_id', 's')
            ->join('s.league_id', 'l')
            ->join('l.sport', 'sp')
            ->where('uht.id_user = :userId')
            ->andWhere('sp.url = :sportUrl')
            ->setParameter('userId', $userId)
            ->setParameter('sportUrl', $sportUrl)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return UserHasFavoriteTeam[] Returns an array of UserHasFavoriteTeam objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserHasFavoriteTeam
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
