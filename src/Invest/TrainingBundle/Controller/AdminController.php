<?php
/**
 * Created by PhpStorm.
 * User: kamil
 * Date: 09.05.18
 * Time: 16:58
 */

namespace Invest\TrainingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Invest\TrainingBundle\Helper\Journal\Journal;
use Invest\TrainingBundle\Helper\DataProvider;
use Symfony\Component\DomCrawler\Field\ChoiceFormField;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Invest\TrainingBundle\Form\Type\RegisterType;
use Invest\TrainingBundle\Entity\Register;

/**
 * @Route("/blog/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route(
     *     "/",
     *     name="edu_blog_admin_listing"
     * )
     *
     * @Template("Admin/listing.html.twig")
     */
    public function listingAction() {

        $Repo = $this->getDoctrine()->getRepository(Register::class);
        $rows = $Repo->findAll();

        return array(
            'rows' => $rows
        );
    }

    /**
     * @Route(
     *     "/details/{id}",
     *     name="edu_blog_admin_details"
     * )
     *
     * @Template("Admin/details.html.twig")
     */
    public function detailsAction($id) {
        $Repo = $this->getDoctrine()->getRepository(Register::class);
        $Register = $Repo->find($id);

        if(NULL == $Register) {
            throw $this->createNotFoundException('Nie znaleziono takiej rejestracji na szkolenie');
        }

        return array(
            'register' => $Register
        );
    }

    /**
     * @Route(
     *     "/update/{id}",
     *     name="edu_blog_admin_update"
     * )
     *
     * @Template("Admin/update.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $Repo = $this->getDoctrine()->getRepository(Register::class);
        $Register = $Repo->find($id);

        if(NULL == $Register) {
            throw $this->createNotFoundException('Nie znaleziono takiej rejestracji na szkolenie');
        }

        $form = $this->createForm(RegisterType::class, $Register);

        if($request->isMethod('POST')) {
            $Session = $this->get('session');
            $form->handleRequest($request);

            if($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($Register);
                $em->flush();

                $Session->getFlashBag()->add('success', 'Zaktualizowano rekord');

                return $this->redirect($this->generateUrl('edu_blog_admin_details', array(
                    'id' => $Register->getId()
                )));

            } else {
                $Session->getFlashBag()->add('danger', 'Popraw błędy formularza');
            }
        }

        return array(
            'form' => $form->createView(),
            'register' => $Register
        );
    }

    /**
     * @Route(
     *     "/delete/{id}",
     *     name="edu_blog_admin_delete"
     * )
     */
    public function deleteAction($id) {
        $Repo = $this->getDoctrine()->getRepository(Register::class);
        $Register = $Repo->find($id);

        if(NULL == $Register) {
            throw $this->createNotFoundException('Nie znaleziono takiej rejestracji na szkolenie');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($Register);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto rekord z bazy danych');
        return $this->redirect($this->generateUrl('edu_blog_admin_listing'));
    }
}