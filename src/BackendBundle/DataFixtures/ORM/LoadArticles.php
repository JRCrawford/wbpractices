<?php
namespace BackendBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use BackendBundle\Entity\Article;

class LoadArticles implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $articleDev = new Article();
        $articleDev->setTitle("Title for demo Web Dev article");
        $articleDev->setContent("This is some dummy data for the web development article content.");
        $articleDev->setSlug("demo-article-dev");
        $manager->persist($articleDev);

        $articleManager = new Article();
        $articleManager->setTitle("Title for Project Management Web article");
        $articleManager->setContent("This is some dummy data for the project management article content.");
        $articleManager->setSlug("demo-article-manager");
        $manager->persist($articleManager);

        $articleMarketing = new Article();
        $articleMarketing->setTitle("Title for demo Marketing article");
        $articleMarketing->setContent("This is some dummy data for the actual Marketing article content.");
        $articleMarketing->setSlug("demo-article-marketing");
        $manager->persist($articleMarketing);

        $manager->flush();
    }
}
