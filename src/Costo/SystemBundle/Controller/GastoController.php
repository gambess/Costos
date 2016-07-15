<?php

namespace Costo\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Costo\SystemBundle\Model\Gasto;
use Costo\SystemBundle\Model\GastoQuery;
use Costo\SystemBundle\Form\Type\GastoType;

class GastoController extends Controller {

    /**
     * Lanza la pagina de inicio
     * Si necesita parametro y muestra un listado de las cuentas existentes en base de datos por id de cuenta
     * @method GET route: "/" name="index_gasto"
     * @param int $id
     * @return Response view 
     */
    public function indexAction($id = 0) {

        $gastos = GastoQuery::create()
                        ->_if($id != 0)
                        ->filterByFkCuenta($id)
                        ->_endif()
                        ->orderByFechaCreacionGasto('DESC')
                        ->find();
        return $this->render('CostoSystemBundle:Gasto:index.html.twig', array(
            'gastos' => $gastos
        ));
    }

    /**
     * Finds and displays a gasto.
     *
     */
    public function showAction($id) {
        $gasto = GastoQuery::create()->findPk($id);

        if (!$gasto) {
            throw $this->createNotFoundException('No se ha encontrado el gasto solicitado');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CostoSystemBundle:Gasto:show.html.twig', array(
            'gasto' => $gasto,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Lanza el formulario de Creación
     * No necesita parametros
     * @method GET route: "/" name="new_gasto"
     * @param int $id
     * @return Response view
     */
    public function newAction() {
        $gasto = new Gasto();
        $form = $this->createForm(new GastoType(), $gasto);
        return $this->render('CostoSystemBundle:Gasto:new.html.twig', array(
            'gasto' => $gasto,
            'form' => $form->createView()
        ));
    }

    /**
     * Creates a new gasto.
     *
     */
    public function createAction() {
        $gasto = new Gasto();
        $request = $this->getRequest();
        $form = $this->createForm(new GastoType(), $gasto);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $gasto->save();
            return $this->redirect($this->generateUrl('show_gasto', array('id' => $gasto->getIdGasto())));
        }

        return $this->render('CostoSystemBundle:Gasto:new.html.twig', array(
            'gasto' => $gasto,
            'form' => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an gasto.
     *
     */
    public function editAction($id) {
        $gasto = GastoQuery::create()->findPk($id);

        if (!$gasto) {
            throw $this->createNotFoundException('No se ha encontrado el gasto solicitado');
        }

        $editForm = $this->createForm(new GastoType(), $gasto);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CostoSystemBundle:Gasto:edit.html.twig', array(
            'gasto' => $gasto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an gasto.
     *
     */
    public function updateAction($id) {
        $gasto = GastoQuery::create()->findPk($id);

        if (!$gasto) {
            throw $this->createNotFoundException('No se ha encontrado el gasto solicitado');
        }

        $editForm = $this->createForm(new GastoType(), $gasto);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $gasto->save();

            return $this->redirect($this->generateUrl('show_gasto', array('id' => $id)));
        }

        return $this->render('CostoSystemBundle:Gasto:edit.html.twig', array(
            'gasto' => $gasto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gasto.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $gasto = GastoQuery::create()->findPk($id);

            if (!$gasto) {
                throw $this->createNotFoundException('No se ha encontrado el gasto solicitado');
            }

            $gasto->delete();
        }

        return $this->redirect($this->generateUrl('index_gasto'));
    }

    /**
     * Contar gastos de una cuenta
     * @param int $id primary key de la cuenta
     * @return int
     */
//    public function countGastos($id)
//    {
//        $gasto = GastoQuery::create()->filterByFkCuenta($id)->count();
//        $r = new \Symfony\Component\HttpFoundation\Response($gasto);
//    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                ->add('id', 'hidden')
                ->getForm()
        ;
    }
}