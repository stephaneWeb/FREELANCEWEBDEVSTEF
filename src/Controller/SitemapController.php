<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SitemapController extends AbstractController
{
    #[Route('/sitemap.xml', name: 'app_sitemap')]
    public function index(): Response
    {
        $urls = [
            [
                'loc' => 'https://atelierhalo.fr/',
                'priority' => '1.0',
                'changefreq' => 'weekly',
            ],
            [
                'loc' => 'https://atelierhalo.fr/contact',
                'priority' => '0.8',
                'changefreq' => 'monthly',
            ],
            [
                'loc' => 'https://atelierhalo.fr/cgv',
                'priority' => '0.3',
                'changefreq' => 'yearly',
            ],
        ];

        $xml = $this->renderView('sitemap/index.xml.twig', [
            'urls' => $urls,
        ]);

        return new Response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
