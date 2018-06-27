<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 09.05.18
 * Time: 16:48
 */

namespace Invest\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class Pages extends Controller
{

    /**
     * @Route("/about")
     *
     * @Template("Blog/index.html.twig")
     */
    public function aboutAction() {
        return array();
    }
}