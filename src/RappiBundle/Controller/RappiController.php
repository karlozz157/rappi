<?php

namespace RappiBundle\Controller;

use RappiBundle\Form\Type\CubeSummationType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/rappi")
 */
class RappiController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET"})
     * @Template()
     * 
     * @return array
     */
    public function indexAction()
    {
        $form = $this->createForm(new CubeSummationType());
        
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/cube-summation")
     * @Method({"POST"})
     * 
     * @param Request $request
     * @return type
     */
    public function processAction(Request $request)
    {
        $form = $this->createForm(new CubeSummationType());
        $form->handleRequest($request);
        $status = Response::HTTP_OK;
        
        if (!$form->isValid()) {
            $output = $form->getErrors();
            $status = Response::HTTP_BAD_REQUEST;
        } else {
            $input  = $form->getData()['input'];
            $output = $this->get('rappi.cube_summation.handler')->process($input);   
        }

        return new JsonResponse(['output' => $output], $status);
    }
}
