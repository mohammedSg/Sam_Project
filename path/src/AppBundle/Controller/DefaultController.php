<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

// http://localhost/symfony2/path/web/app_dev.php/lucky/number     http://localhost/symfony2/path/web/app_dev.php/
class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
    
  
     /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction($count,  Request $request)
    {
       /* $product = 0;
        if (!$product) {
        throw $this->createNotFoundException('The product does not exist');
        }*/
        
        $page = $request->query->get('page', 10);
        print($page);
        
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);
        
        //Passage par une template 
        $html = $this->container->get('templating')->render('default/number.html.twig',array('luckyNumberList' => $numbersList));
        return new Response($html);
        
        //Ou directement utilser le service render()
        // return $this->render('default/number.html.twig',array('luckyNumberList' => $numbersList));
        
        // Ou juste dans la fonction Répense
        //return new Response('<html><body>Lucky numbers: '.$numbersList.'</body></html>');
        
        // Une redirection par nom de route                     ou par URL
        // return $this->redirectToRoute('homepage');           return $this->redirect('http://symfony.com/doc');
        // une autre façon de faire
        // return $this->redirect($this->generateUrl('homepage'), 301);   // (redirection (temporaire) 302  ou permanente 301) 
        // ou une autre façon en utilisant la methode Reponse
        // return new RedirectResponse($this->generateUrl('homepage'));
        
    }
    
    /**
     * @Route("/json/lucky/number")
     * 
     * Retourne reponce en JSON
     */
    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );

        /*return new Response(json_encode($data),
                            200,
                            array('Content-Type' => 'application/json')
                           );
        */
        // Appelle json_encode et définit la tête Content-Type
        return new JsonResponse($data);
    }
    
    public function docAction(){
        $session = $request->getSession();

        // store an attribute for reuse during a later user request
        $session->set('foo', 'bar');

        // get the attribute set by another controller in another request
        $foobar = $session->get('foobar');

        // use a default value if the attribute doesn't exist
        $filters = $session->get('filters', array());
    
       //Flash Messages
       $this->get('session')->getFlashBag()->add();
      // code dans la template 
      /*
       {% for flash_message in app.session.flashbag.get('notice') %}
        <div class="flash-notice">
            {{ flash_message }}
        </div>
       {% endfor %}
     */
       
       // L'objet  Request
       
     $request->isXmlHttpRequest(); // is it an Ajax request?

    $request->getPreferredLanguage(array('en', 'fr'));

    $request->query->get('page'); // get a $_GET parameter

    $request->request->get('page'); // get a $_POST parameter
    }
    
    // Redirection dans le Controleur par la methode reponse
   /* $response = $this->forward('AppBundle:Something:fancy', array(
        'name'  => $name,
        'color' => 'green',
    ));*/
}
