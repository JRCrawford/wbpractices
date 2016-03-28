<?php
namespace AppBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use Presta\SitemapBundle\Service\SitemapListenerInterface;
use Presta\SitemapBundle\Event\SitemapPopulateEvent;
use Presta\SitemapBundle\Sitemap\Url\UrlConcrete;

use AppBundle\Entity\Article;

class SitemapListener implements SitemapListenerInterface
{
    private $router;
    private $entityManager;

    public function __construct(RouterInterface $router, EntityManager $entityManager)
    {
        $this->router = $router;
        $this->entityManager = $entityManager;
    }

    /**
     * Generates the actual sitemaps for each section
     * @param SitemapPopulateEvent $event
     */
    public function populateSitemap(SitemapPopulateEvent $event)
    {
        $this->generateStaticPages($event);
        $this->generateArticlePages($event);
    }

    /**
     * Generates the sitemap for static URLs such as homepage, about-us, etc
     * @param SitemapPopulateEvent $event
     */
    private function generateStaticPages(SitemapPopulateEvent $event)
    {
        //get absolute url for homepage
        $url = $this->router->generate('_homepage', array(), UrlGeneratorInterface::ABSOLUTE_URL);

        //add homepage url to the urlset named default
        $event->getGenerator()->addUrl(
            new UrlConcrete(
                $url,
                new \DateTime(),
                null,
                null
            ),
            'static_pages'
        );
    }

    /**
     * Generates the sitemap for the article posts for each category
     * @param SitemapPopulateEvent $event
     */
    private function generateArticlePages(SitemapPopulateEvent $event)
    {
        $articles = $this->entityManager->getRepository('AppBundle:Article')->findAll();
        foreach ($articles as $article) {
            $url = $this->router->generate('_article',
                array(
                    'category'=>$article->getCategory(),
                    'article_slug'=>$article->getSlug()
                ), UrlGeneratorInterface::ABSOLUTE_URL);

            $event->getGenerator()->addUrl(
                new UrlConcrete(
                    $url,
                    new \DateTime(),
                    null,
                    null
                ),
                'article_pages'
            );
        }
    }
}