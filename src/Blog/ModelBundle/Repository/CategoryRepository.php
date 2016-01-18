<?php

namespace Blog\ModelBundle\Repository;

use Blog\ModelBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

class CategoryRepository extends EntityRepository
{
    /**
     * Find the first author
     *
     * @return Category
     *
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->orderBy('a.id', 'asc')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('ModelBundle:Category')
            ->createQueryBuilder('a');

        return $qb;
    }
}