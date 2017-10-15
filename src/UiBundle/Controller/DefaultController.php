<?php

namespace UiBundle\Controller;

use AppBundle\Entity\Specification;
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
        $specifications = $this->get(SpecificationManager::class)->getSchemas();
        $resources = [];
        /** @var Specification $specification */
        foreach ($specifications as $i => $specification) {
            foreach ($specification->getOperations() as $operation) {
                $resources[$i][$operation->getResourceName()][] = $operation;
            }
        }

        return $this->render(
            'UiBundle:Default:index.html.twig',
            [
                'user' => $this->getUser(),
                'specifications' => $specifications,
                'resources' => $resources,
            ]
        );
    }

    /**
     * @Route("/login")
     */
    public function loginAction()
    {
        return $this->render(
            'UiBundle:Default:login.html.twig',
            [
                'user' => $this->getUser(),
                'specifications' => $this->get(SpecificationManager::class)->getSchemas(),
            ]
        );
    }
}
