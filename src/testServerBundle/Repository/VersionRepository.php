<?php

/**
 * Created by PhpStorm.
 * User: sloum
 * Date: 18/11/2016
 * Time: 14:18
 */
namespace testServerBundle\Repository;
use Doctrine\ORM\EntityRepository;
class VersionRepository extends EntityRepository
{
    public  function findByServer($id){
        $query = $this->createQueryBuilder('a')
            ->andWhere('a.Server =:Server')
            ->setParameter('user', $id);
        return $query->getQuery()->getResult();
    }

}