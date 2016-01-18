<?php

namespace Blog\ModelBundle\DataFixtures\ORM;

use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Post Entity
 * @package Blog\ModelBundle\DataFixtures\ORM
 */
class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 15;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Los Angeles Times See realtime coverage Kobe Bryant moves up on Lakers');
        $p1->setBody('Lakers forward Kobe Bryant looks to pass after driving to the basket against the Rockets in the first half. Lakers forward Kobe Bryant looks to pass after driving to the basket against the Rockets in the first half.');
        $p1->setCategory($this->getCategory($manager, 'Sport'));
        $p1->setIsPublished(true);

        $p2 = new Post();
        $p2->setTitle('Washington Post Hillary Clinton just declared Bill Clinton fair game in the 2016 campaign');
        $p2->setBody('Ever since Republican presidential front-runner Donald Trump launched his first attacks on Bill Clinton last month, the media has hemmed and hawed about whether the former president is fair game in the 2016 campaign..');
        $p2->setCategory($this->getCategory($manager, 'Global'));
        $p2->setIsPublished(false);

        $p3 = new Post();
        $p3->setTitle('After 3 days of searching, no sign of missing ski instructor');
        $p3->setBody('NORDEN, Calif. (AP) - The search for a ski instructor who went missing at a Northern California ski resort has been suspended until morning, following a day hampered by bad weather.');
        $p3->setCategory($this->getCategory($manager, 'Local'));
        $p3->setIsPublished(true);

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();
    }

    /**
     * Get an author
     *
     * @param ObjectManager $manager
     * @param string        $name
     *
     * @return \Blog\ModelBundle\Entity\Category
     */
    private function getCategory(ObjectManager $manager, $name)
    {
        return $manager->getRepository('ModelBundle:Category')->findOneBy(
            array(
                'name' => $name,
            )
        );
    }
}