<?php

namespace Costo\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Costo\SystemBundle\Model\Cuenta;
use Costo\SystemBundle\Model\CuentaQuery;
use Costo\SystemBundle\Form\Type\CuentaType;

/**
 * @author Raziel Valle <razielvalle@gambess.com>
 * Controlador de Cuentas, Metods CRUD + List + Search ++
 * Este controlador controla las acciones request de la pagina web
 */
class CuentaController extends Controller {

    /**
     * Lanza la pagina de inicio
     * No necesita parametros y muestra un listado de las cuentas existentes en base de datos
     * @method GET route: "/" name="index_cuenta"
     * @return Response view
     */
    public function indexAction()
    {
        $cuentas = CuentaQuery::create()->orderByFechaCreacionCuenta('DESC')->find();
        return $this->render('CostoSystemBundle:Cuenta:index.html.twig', array(
            'cuentas' => $cuentas,
        ));
    }

    /**
     * Se busca y muestra una cuenta
     * Necesita el id de la cuenta a mostrar
     * @param int $id
     * @method GET route: "/{id}/show", name="show_cuenta"
     * @return Response view
     */
        public function showAction($id)
    {
        $cuenta = CuentaQuery::create()->findPk($id);

        if (!$cuenta) {
            throw $this->createNotFoundException('No se ha encontrado la cuenta solicitada');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CostoSystemBundle:Cuenta:show.html.twig', array(
            'cuenta'      => $cuenta,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Muestra el Formulario de Creación de una nueva cuenta
     * No necesita parametros
     * @method GET route: "/new" name="new_cuenta"
     * @return Response view
     */
    public function newAction()
    {
        $cuenta = new Cuenta();
        $form   = $this->createForm(new CuentaType(), $cuenta);

        return $this->render('CostoSystemBundle:Cuenta:new.html.twig', array(
            'cuenta' => $cuenta,
            'form'   => $form->createView()
        ));
    }

    /**
     * Guarda una cuenta y redirije o espera validacion del formulario
     * No necesita parametros
     * @method POST route: "/create" name="create_cuenta"
     * @return mixed, Si es valido se muestra el cuenta creado en caso contrario exije validacion
     */
    public function createAction()
    {
        $cuenta  = new Cuenta();
        $request = $this->getRequest();
        $form    = $this->createForm(new CuentaType(), $cuenta);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $cuenta->save();
            return $this->redirect($this->generateUrl('show_cuenta', array('id' => $cuenta->getIdCuenta())));

        }

        return $this->render('CostoSystemBundle:Cuenta:new.html.twig', array(
            'cuenta' => $cuenta,
            'form'   => $form->createView()
        ));
    }

    /**
     * Muestra el formulario de edicion de una cuenta
     * Necesita el id de la cuenta a editar
     * @method GET route: "/{id}/edit" name="edit_cuenta"
     * @param int $id
     * @return mixed, renderiza el formulario de edicion o un error en caso de no encontrar la cuenta
     */
    public function editAction($id)
    {
       $cuenta = CuentaQuery::create()->findPk($id);

        if (!$cuenta) {
            throw $this->createNotFoundException('No se ha encontrado la cuenta solicitada');
        }

        $editForm = $this->createForm(new CuentaType(), $cuenta);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CostoSystemBundle:Cuenta:edit.html.twig', array(
            'cuenta'      => $cuenta,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Actualiza y guarda un cuenta
     * Necesita un parametro el id del cuenta a actualizar
     * @method PUT route: "/{id}/update" name="update_cuenta"
     * @param int $id
     * @return mixed, muestra un error o el formulario de cuentas en caso de que no sea valido
     */
    public function updateAction($id)
    {
         $cuenta = CuentaQuery::create()->findPk($id);

        if (!$cuenta) {
            throw $this->createNotFoundException('No se ha encontrado la cuenta solicitada');
        }

        $editForm = $this->createForm(new CuentaType(), $cuenta);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $cuenta->save();

            return $this->redirect($this->generateUrl('show_cuenta', array('id' => $id)));
        }

        return $this->render('CostoSystemBundle:Cuenta:edit.html.twig', array(
            'cuenta'      => $cuenta,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Borra una Cuenta
     * Necesita el id de la cuenta a borrar
     * @method GET route: "/{id}/delete" name="delete_cuenta"
     * @param int $id
     * @return mixed
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $cuenta = CuentaQuery::create()->findPk($id);

            if (!$cuenta) {
            throw $this->createNotFoundException('No se ha encontrado la cuenta solicitada');
            }

            $cuenta->delete();
        }

        return $this->redirect($this->generateUrl('index_cuenta'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}