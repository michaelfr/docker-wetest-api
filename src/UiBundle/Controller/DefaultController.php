<?php

namespace UiBundle\Controller;

use AppBundle\Service\SpecificationManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render(
            'UiBundle:Default:index.html.twig',
            [
                'schemas' => $this->get(SpecificationManager::class)->getSchemas(),
            ]
        );
    }
}
