<?php

namespace Blog\CoreBundle\Services;

use Blog\ModelBundle\Entity\Category;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryManager
 * @package Blog\CoreBundle\Services
 */
class CategoryManager
{
    private $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Find Category by slug
     *
     * @param string $slug
     *
     * @throws NotFoundHttpException
     * @return Category
     */
    public function findBySlug($slug)
    {
        $category = $this->em->getRepository('ModelBundle:Category')->findOneBy(
            array(
                'slug' => $slug,
            )
        );

        if (null === $category) {
            throw new NotFoundHttpException('Category was not found');
        }

        return $category;
    }

    /**
     * Find all posts for a given category
     *
     * @param Category $category
     *
     * @return array
     */
    public function findPosts(Category $category)
    {
        $posts = $this->em->getRepository('ModelBundle:Post')->findBy(
            array(
                'category' => $category,
                'isPublished' => 1
            )
        );

        return $posts;
    }

    /**
     * Find all Categories
     */
    public function findAll()
    {

        $category = $this->em->getRepository('ModelBundle:Category')->findAll();

        return $category;

    }
}