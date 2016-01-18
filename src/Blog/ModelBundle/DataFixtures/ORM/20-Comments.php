<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Comment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Comment Entity
 * @package Blog\ModelBundle\DataFixtures
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 20;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository('ModelBundle:Post')->findAll();

        $comments = array(
            0 => 'Donec non ultricies felis. Proin aliquet elementum auctor. Duis tellus libero, molestie eget turpis
            eu, bibendum pretium urna. Aenean sit amet eros et dolor condimentum feugiat vel et odio. Aliquam vitae
            maximus est. Proin sed finibus mi. Donec ipsum lacus, ullamcorper quis aliquet ac, interdum non quam.
            Proin purus nisl, pulvinar ac viverra ac, dapibus eu est. Donec a metus dolor. Vivamus ac felis aliquam,
            semper ligula id, finibus turpis.',
            1 => 'Cras eleifend, tellus et varius consequat, ligula quam imperdiet dolor, sed pulvinar lacus diam a
            sem. Vestibulum lacus metus, aliquam eu metus quis, congue bibendum quam. Pellentesque habitant morbi
            tristique senectus et netus et malesuada fames ac turpis egestas. Nulla at odio id tellus pulvinar tempus
            eu vitae purus. Praesent a bibendum dolor. Suspendisse potenti. Lorem ipsum dolor sit amet, consectetur
            adipiscing elit. Phasellus ipsum metus, varius quis tortor nec, varius viverra lectus. Pellentesque augue
            magna, suscipit nec ipsum vitae, viverra commodo sapien. Aenean nec luctus erat.',
            2 => 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis placerat, neque ac laoreet
            molestie, enim neque cursus arcu, sed accumsan est lectus a neque. Mauris dapibus, nibh in viverra
            elementum, ipsum justo laoreet purus, quis efficitur nisi nulla vel dui. Nam volutpat id justo nec
            pulvinar. Nunc mattis nunc dui, quis auctor tortor rhoncus sed. Phasellus nunc leo, elementum id
            tincidunt et, consequat sit amet nibh. Donec consequat mi et mi venenatis pretium. Suspendisse libero
            erat, auctor eget dolor vitae, gravida hendrerit lacus. Cras nec nisi mattis, tristique nibh in, dapibus
            tellus. Duis lacinia mauris elementum mauris euismod, in dignissim sapien laoreet. Nam dapibus eleifend
            justo, ac sagittis elit fringilla at. Sed nec dui sem.',
        );

        $i = 0;

        foreach ($posts as $post) {
            $comment = new Comment();
            $comment->setAuthorName('Someone');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);

            $manager->persist($comment);
        }

        $manager->flush();
    }
}