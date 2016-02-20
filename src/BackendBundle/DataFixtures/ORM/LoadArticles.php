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
        $articleDev->setSummary("This is a summary Dev");
        $articleDev->setContent("This is some dummy data for the web development article content.");
        $articleDev->setSlug("demo-article-dev");
        $articleDev->setCategory("development");
        $articleDev->setDatePosted(new \DateTime("2016-01-01 01:01:01"));
        $manager->persist($articleDev);

        $articleManager = new Article();
        $articleManager->setTitle("Title for Project Management Web article");
        $articleManager->setSummary("This is a summary Management");
        $articleManager->setContent("This is some dummy data for the project management article content.");
        $articleManager->setSlug("demo-article-manager");
        $articleManager->setCategory("management");
        $articleManager->setDatePosted(new \DateTime("2016-02-02 02:02:02"));
        $manager->persist($articleManager);

        $articleMarketing = new Article();
        $articleMarketing->setTitle("Title for demo Marketing article");
        $articleMarketing->setSummary("This is a summary Marketing");
        $articleMarketing->setContent("This is some dummy data for the actual Marketing article content.");
        $articleMarketing->setSlug("demo-article-marketing");
        $articleMarketing->setCategory("online-marketing");
        $articleMarketing->setDatePosted(new \DateTime("2016-03-03 03:03:03"));
        $manager->persist($articleMarketing);

        $manager->flush();
    }
}
