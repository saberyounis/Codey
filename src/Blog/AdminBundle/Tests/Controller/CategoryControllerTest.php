<?php

namespace Blog\ModelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class CategoryControllerTest
 * @package Blog\ModelBundle\Tests\Controller
 */
class CategoryControllerTest extends WebTestCase
{
    /**
     * Test Category CRUD
     */
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW'   => 'admin',
        ));

        // Create a new entry in the database
        $crawler = $client->request('GET', '/admin/category/');
        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful');
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(
            array(
                'blog_modelbundle_category[name]' => 'Someone',
            )
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(
            0,
            $crawler->filter('td:contains("Someone")')->count(),
            'The new category is not showing up'
        );

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(
            array
            (
                'blog_modelbundle_category[name]' => 'Another one',
            )
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Category one"
        $this->assertGreaterThan(0, $crawler->filter('[value="Category one"]')->count(), 'The edited category is not showing up');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been deleted on the list
        $this->assertNotRegExp('/Category one/', $client->getResponse()->getContent());
    }
}
