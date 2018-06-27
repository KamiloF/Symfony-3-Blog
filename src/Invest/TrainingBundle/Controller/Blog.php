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
 * @Route("/blog")
 */
class Blog extends Controller
{

    /**
     * @Route(
     *     "/",
     *     name="edu_blog_glowna"
     * )
     *
     * @Template("Blog/index.html.twig")
     */
    public function indexAction() {
        return array();
    }

    /**
     * @Route(
     *     "/dziennik",
     *     name="edu_blog_dziennik"
     * )
     *
     * @Template("Blog/journal.html.twig")
     */
    public function journalAction() {
        return array(
//            'history' => Journal::getHistoryAsArray()
            'history' => Journal::getHistoryAsObjects()
        );
    }

    /**
     * @Route(
     *     "/o-mnie",
     *     name="edu_blog_oMnie"
     *     )
     *
     * @Template("Blog/about.html.twig")
     */
    public function aboutAction() {
        return array();
    }

    /**
     * @Route(
     *     "/kontakt",
     *     name="edu_blog_kontakt"
     *     )
     *
     * @Template("Blog/contact.html.twig")
     */
    public function contactAction() {
        return array();
    }

    /**
     * @Route(
     *     "/rejestracja",
     *     name="edu_blog_rejestracja"
     * )
     *
     * @Template("Blog/register.html.twig")
     */
    public function registerAction(Request $request){

        $Register = new Register();
        /*$Register->setName('Kamil Kamil')
            ->setEmail('kamil_fajbus@wp.pl')
            ->setCountry('PL')
            -> setCourse('basic')
            ->setInvest(array('a', 'c'));*/

        $Session = $this->get('session');

        if(!$Session->has('registered')) {

            $form = $this->createForm(RegisterType::class, $Register);

            $form->handleRequest($request);

            if ($request->isMethod('POST')) {
                if ($form->isValid()) {

                    $savePath = $this->get('kernel')->getRootDir() . '/../web/uploads';
                    $Register->save($savePath);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($Register);
                    $em->flush();

                    $msgBody = $this->renderView('Email/base.html.twig', array(
                        'name' => $Register->getName()
                    ));

                    $message = \Swift_Message::newInstance()
                        ->setSubject('Potwierdzenie rejestracji')
                        ->setFrom(array('testowy.project2@gmail.com' => 'Edu Inwestor'))
                        ->setTo(array($Register->getEmail() => $Register->getName()))
                        ->setBody($msgBody, 'text/html');

                    $this->get('mailer')->send($message);

                    $Session->getFlashBag()->add('success', 'Twoje zgłoszenie zostało zapisane!');
                    $Session->set('registered', true);

                    return $this->redirect($this->generateUrl('edu_blog_rejestracja'));
                } else {
                    $Session->getFlashBag()->add('danger', 'Popraw błędy formularza.');
                }
            }
        }

        return array(
            'form' => isset($form) ? $form->createView() : NULL,
        );
    }
}