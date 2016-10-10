<?php

namespace ArticleBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class ArticleRepository extends EntityRepository {

    public function findNewArticles() {
        return $this->createQueryBuilder('a')
            //->where('a.newsletter IS NULL')
            ->where('a.online = :status')
            ->setParameter('status', '1')
            ->getQuery()
            ->getResult();
    }

  public function findOnline()
  {
      return $this->findBy(array('online'=>true),array('datePublication'=>'DESC')
    );
  }

}
