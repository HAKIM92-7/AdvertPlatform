<?php
namespace App\Controller;

use App\Antispam\Antispam;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Nouveau use

/**
 * @Route("/advert")
 */

class AdvertController extends AbstractController
{

    public function menuAction()
    {
        // On fixe en dur une liste ici, bien entendu par la suite
        // on la récupérera depuis la BDD !
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission de webmaster'),
            array('id' => 9, 'title' => 'Offre de stage webdesigner'),
        );

        return $this->render('Advert/menu.html.twig', [
            // Tout l'intérêt est ici : le contrôleur passe
            // les variables nécessaires au template !
            'listAdverts' => $listAdverts]
        );
    }

    /**
     * @Route("/", name="oc_advert_index")
     */
    public function index()
    {
        // Notre liste d'annonce en dur
        $listAdverts = array(
            array(
                'title' => 'Recherche développpeur Symfony',
                'id' => 1,
                'author' => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
                'date' => new \Datetime()),
            array(
                'title' => 'Mission de webmaster',
                'id' => 2,
                'author' => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date' => new \Datetime()),
            array(
                'title' => 'Offre de stage webdesigner',
                'id' => 3,
                'author' => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date' => new \Datetime()),
        );
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1

        return $this->render('Advert/index.html.twig', ['listAdverts' => $listAdverts]);

    }

/**
 * @Route("/{id}", name="oc_advert_view", requirements={"id"="\d+"})
 */
    public function view1($id)
    {
        // $id vaut 5 si l'URL appelée est /advert/view/5
        $advert = array(
            'title' => 'Recherche développpeur Symfony2',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date' => new \Datetime(),
        );
        return $this->render('Advert/view.html.twig', ['advert' => $advert]);
    }

    public function view2($id)
    {
        // $id vaut 5 si l'URL appelée est /advert/view/5
        $advert = array(
            'title' => 'Mission de webmaster',
            'id' => $id,
            'author' => 'Hugo',
            'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
            'date' => new \Datetime(),
        );
        return $this->render('Advert/view.html.twig', ['advert' => $advert]);
    }

    public function view3($id)
    {
        // $id vaut 5 si l'URL appelée est /advert/view/5
        $advert = array(
            'title' => 'Offre de stage webdesigner',
            'id' => $id,
            'author' => 'Mathieu',
            'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
            'date' => new \Datetime(),

        );
        return $this->render('Advert/view.html.twig', ['advert' => $advert]);
    }

    /**
     * @Route("/view/{year}/{slug}.{_format}", name="oc_advert_view_slug", requirements={
     *   "year"   = "\d{4}",
     *   "format" = "html|xml"
     * }, defaults={"_format" = "html"})
     */
    public function viewSlug($slug, $year, $_format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
    slug '" . $slug . "', créée en " . $year . " et au format " . $_format . "."
        );
    }

/**
 * @Route("/add", name="oc_advert_add")
 */
    public function add(Antispam $antispam)
    {
        $text = '...';
        if ($antispam->isSpam($text)) {
            throw new \Exception('Votre message a été détecté comme spam !');
        }
        return $this->render('Advert/add.html.twig');

    }

/**
 * @Route("/edit/{id}", name="oc_advert_edit", requirements={"id" = "\d+"})
 */
    public function edit($id)
    {
        $advert = array(
            'title' => 'Recherche développpeur Symfony',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
            'date' => new \Datetime(),
        );

        return $this->render('Advert/edit.html.twig', ['advert' => $advert]);

    }

/**
 * @Route("/delete/{id}", name="oc_advert_delete", requirements={"id" = "\d+"})
 */
    public function delete($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

    }

}
