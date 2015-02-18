<?php

namespace Lcn\WYSIHTML5Bundle\Controller;


use Lcn\WYSIHTML5Bundle\Entity\Demo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends Controller
{

    /**
     * Show demo entity
     *
     * @param Request $request
     * @param Demo $entity
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Request $request, Demo $entity)
    {
        return $this->render('LcnWYSIHTML5Bundle:Demo:show.html.twig', array(
          'entity' => $entity,
        ));
    }

    public function createOrUpdateAction(Request $request, Demo $entity = null)
    {
        if ($entity) {
            $formMethod = 'PUT';
            $formAction = $this->generateUrl('lcn_wysihtml5_demo_edit', array('id' => $entity->getId()));
        }
        else {
            $formAction = $this->generateUrl('lcn_wysihtml5_demo_create');
            $formMethod = 'POST';
            $entity = new Demo();
        }

        $form = $this->createFormBuilder($entity)
          ->setAction($formAction)
          ->setMethod($formMethod)
          ->add('html', 'lcn_wysihtml5')
          ->getForm();

        if ($request->getMethod() == 'POST' || $request->getMethod() == 'PUT') {
            $form->submit($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                return $this->redirect($this->generateUrl('lcn_wysihtml5_demo_show', array('id'  => $entity->getId())));
            }
        }

        return $this->render('LcnWYSIHTML5Bundle:Demo:createOrUpdate.html.twig', array(
          'entity' => $entity,
          'form' => $form->createView(),
        ));
    }

}

