<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CategoryControllerTest
 * @package Blog\CoreBundle\Tests\Controller
 */
class CategoryControllerTest extends WebTestCase
{
    /**
     * Test show category
     */
    public function testShow()
    {
        $client = static::createClient();

        /** @var Category $category */
        $category = $client->getContainer()->get('doctrine')->getManager()->getRepository('ModelBundle:Category')->findFirst();
        $categoryPostsCount = $category->getPosts()->count();

        $crawler = $client->request('GET', '/category/'.$category->getSlug());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful');

        $this->assertCount($categoryPostsCount, $crawler->filter('h2'), 'There should be '.$categoryPostsCount.' posts');
    }

}
