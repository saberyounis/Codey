<?php

namespace Blog\ModelBundle\Repository;

use Blog\ModelBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 * @package Blog\ModelBundle\Repository
 */
class PostRepository extends EntityRepository
{
    /**
     * Find latest
     *
     * @param int $num How many posts to get
     *
     * @return array
     */
    public function findLatest($num)
    {
        $qb = $this->getQueryBuilder()
            ->where('p.isPublished = 1')
            ->orderBy('p.createdAt', 'desc')
            ->setMaxResults($num);

        return $qb->getQuery()->getResult();
    }

    /**
     * Find the first post
     *
     * @return Post
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->where('p.isPublished = 1 ')
            ->orderBy('p.id', 'asc')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository('ModelBundle:Post')
            ->createQueryBuilder('p');

        return $qb;
    }
}