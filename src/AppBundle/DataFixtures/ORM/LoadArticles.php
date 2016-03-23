<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Article;

class LoadArticles implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $articleDev = new Article();
        $articleDev->setTitle("Title for demo Web Dev article");
        $articleDev->setSummary("This is a summary Dev");
        $articleDev->setContent("This is some dummy data for the web development article content.");
        $articleDev->setMainImage("http://i.imgur.com/oPcT6TC.jpg");
        $articleDev->setSlug("demo-article-dev");
        $articleDev->setCategory("development");
        $articleDev->setDatePosted(new \DateTime("2016-01-01 01:01:01"));
        $articleDev->setTitleColour("black-title");
        $manager->persist($articleDev);

        $articleManager = new Article();
        $articleManager->setTitle("Title for Project Management Web article");
        $articleManager->setSummary("This is a summary Management");
        $articleManager->setContent("This is some dummy data for the project management article content.");
        $articleManager->setMainImage("http://i.imgur.com/3O2kOG4.jpg");
        $articleManager->setSlug("demo-article-manager");
        $articleManager->setCategory("management");
        $articleManager->setDatePosted(new \DateTime("2016-02-02 02:02:02"));
        $articleManager->setTitleColour("white-title");
        $manager->persist($articleManager);

        $articleMarketing = new Article();
        $articleMarketing->setTitle("Title for demo Marketing article");
        $articleMarketing->setSummary("This is a summary Marketing");
        $articleMarketing->setContent('
                    <p>Never in all their history have men been able truly to conceive of the world as one: a single sphere, a globe, having the qualities of a globe, a round earth in which all the directions eventually meet, in which there is no center because every point, or none, is center — an equal earth which all men occupy as equals. The airman\'s earth, if free men make it, will be truly round: a globe in practice, not in theory.</p>
                    <p>Science cuts two ways, of course; its products can be used for both good and evil. But there\'s no turning back from science. The early warnings about technological dangers also come from science.</p>
                    <h2 class="section-heading">The Final Frontier</h2>
                    <p>Spaceflights cannot be stopped. This is not the work of any one man or even a group of men. It is a historical process which mankind is carrying out in accordance with the natural laws of human development.</p>
                    <a href="#">
                        <img class="img-responsive" src="http://blackrockdigital.github.io/startbootstrap-clean-blog/img/post-sample-image.jpg" alt="">
                    </a>
                    <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span>
                    <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p>
                    <p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there’s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p>
                    <p>Placeholder text by <a href="http://spaceipsum.com/">Space Ipsum</a>. Photographs by <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>.</p>
                    ');
        $articleMarketing->setMainImage("http://i.imgur.com/fOg16kD.jpg");
        $articleMarketing->setSlug("demo-article-marketing");
        $articleMarketing->setCategory("online-marketing");
        $articleMarketing->setDatePosted(new \DateTime("2016-03-03 03:03:03"));
        $articleMarketing->setTitleColour("black-title");
        $manager->persist($articleMarketing);

        $manager->flush();
    }
}
