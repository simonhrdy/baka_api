<?php

namespace App\Repository;

use App\Entity\Game;
use App\Enum\Status;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Game>
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    public function findByDateAndSport(\DateTimeInterface $date, string $sport)
    {
        return $this->createQueryBuilder('g')
            ->join('g.league_id', 'l')
            ->join('l.sport', 's')
            ->where('g.date_of_game >= :startDate')
            ->andWhere('g.date_of_game < :endDate')
            ->andWhere('s.url = :sport')
            ->setParameter('startDate', $date->format('Y-m-d 00:00:00'))
            ->setParameter('endDate', $date->format('Y-m-d 23:59:59'))
            ->setParameter('sport', $sport)
            ->getQuery()
            ->getResult();
    }

    public function findLastFiveGamesByTeamAndStatus(int $teamId): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.home_team_id = :teamId OR g.away_team_id = :teamId')
            ->andWhere('g.status = :status')
            ->setParameter('teamId', $teamId)
            ->setParameter('status', Status::NOT_STARTED)
            ->orderBy('g.date_of_game', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findFiveResult(int $teamId): array
    {
        return $this->createQueryBuilder('g')
            ->where('g.home_team_id = :teamId OR g.away_team_id = :teamId')
            ->andWhere('g.status = :status')
            ->setParameter('teamId', $teamId)
            ->setParameter('status', Status::COMPLETED)
            ->orderBy('g.date_of_game', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findLastFiveCompletedGamesByPlayerId(int $playerId)
    {
        return $this->createQueryBuilder('g')
            ->innerJoin('g.home_team_id', 'home_team')
            ->innerJoin('g.away_team_id', 'away_team')
            ->innerJoin('home_team.players', 'home_players')
            ->innerJoin('away_team.players', 'away_players')
            ->where('home_players.id = :playerId OR away_players.id = :playerId')
            ->andWhere('g.status = :status')
            ->setParameter('playerId', $playerId)
            ->setParameter('status', 1) // Status::COMPLETED
            ->orderBy('g.date_of_game', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findBySuperviserAndDate(int $superviserId, \DateTimeInterface $date): array
    {
        $startDate = (clone $date)->setTime(0, 0, 0);
        $endDate = (clone $date)->setTime(23, 59, 59);

        return $this->createQueryBuilder('g')
            ->where('g.superviser_id = :superviserId')
            ->andWhere('g.date_of_game BETWEEN :start AND :end')
            ->setParameter('superviserId', $superviserId)
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return Game[] Returns an array of Game objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Game
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
