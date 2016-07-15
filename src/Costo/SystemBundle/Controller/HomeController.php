<?php

namespace Costo\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @author Raziel Valle <razielvalle@gambess.com>
 * Controlador de HomePage, Metods CRUD+
 * Este controlador controla las acciones request de la pagina web
 */
class HomeController extends Controller {

    /**
     * Lanza la pagina de inicio
     * No necesita parametros
     * @method GET route: "/" name="_homepage"
     * @return Response view
     */
    public function indexAction()
    {
        return $this->render('CostoSystemBundle:Home:index.html.twig');
    }

}