<?php

namespace Costo\SystemBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use \PropelCollection;
use Costo\SystemBundle\Model\Venta;
use Costo\SystemBundle\Model\VentaQuery;
use Costo\SystemBundle\Model\Gasto;
use Costo\SystemBundle\Model\GastoQuery;

/**
 * @author Raziel Valle <razielvalle@gambess.com>
 * Controlador de HomePage, Metods CRUD+
 * Este controlador controla las acciones request de la pagina web
 */
class InformeController extends Controller {

    /**
     * Lanza la pagina de inicio
     * No necesita parametros
     * @method GET route: "/" name="_homepage"
     * @return Response view
     */
    public function indexAction() {

        $form = $this->generateForm();
        return $this->render('CostoSystemBundle:Informe:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * Generador de Informes
     * @param string $format
     * @return mixed
     */
    public function reportAction() {

        $dates = array();
        $request = $this->getRequest();

        if ('POST' === $request->getMethod()) {

            // Se recuperan las fechas
            $dates = $request->request->get('form');
            //Se genera el formulario
            $form = $this->generateForm();
            // Se ponen las fechas elejidas en el formulario nuevamente
            $form->bindRequest($request);

            //Se convierten las fechas en Objetos DateTime y se almacenan en un arreglo con los indices mix y max
            $timeline = $this->proccessDates($dates);

            //Calculo de Intervalos
            $intervalo = $timeline['min']->diff($timeline['max'], true);

            //variables a definir para el cuadro informativo de ingresos totales
            $gyformal = 0;
            $gyinformal = 0;
            $vyformal = 0;
            $vyinformal = 0;
            $giva = 0;
            $viva = 0;
            //variables a definir para el cuadro informativo de ingresos de las fechas seleccionadas
            $gmformal = 0;
            $gminformal = 0;
            $vmformal = 0;
            $vminformal = 0;
            $gmiva = 0;
            $vmiva = 0;
            //Arrays necesarios
            $tmparray = array();
            $gasto = array();
            $gastos = array();
            // Solo se hacen los calculos si:
            // la fecha del textBox de la derecha es mayor que el de la izquierda
            if ($timeline['max'] >= $timeline['min'] && $intervalo->m == 0) {
                //Ventas Totales del Formales, Informales e IVAS Año
                $tventas = $this->getAllVentas();
                //acumulador ventas totales
                foreach ($tventas->getIterator() as $tv) {
                    $vyformal += $tv['v.FormalTotalVenta'];
                    $vyinformal += $tv['v.InformalTotalVenta'];
                    $viva += $tv['v.TotalIvaVentaFormal'];
                }
                // Calculos por fechas
                // VENTAS en rango de fechas
                $ventas = $this->getVentasByDate($timeline);
                if ($ventas->count() == 0) {
                    unset($ventas);
                    if($timeline['max'] > $timeline['min']){
                        $ventas[0] = array(
                            'FechaVenta' => $timeline['min'],
                            'FormalTotalVenta' => 0,
                            'TotalIvaVentaFormal' => 0,
                            'InformalTotalVenta' => 0,
                            'TotalVenta' => 0,
                        );
                        $ventas[1] = array(
                            'FechaVenta' => $timeline['max'],
                            'FormalTotalVenta' => 0,
                            'TotalIvaVentaFormal' => 0,
                            'InformalTotalVenta' => 0,
                            'TotalVenta' => 0,
                        );
                    }
                    if($timeline['min'] == $timeline['max']){
                        $ventas[0] = array(
                            'FechaVenta' => $timeline['min'],
                            'FormalTotalVenta' => 0,
                            'TotalIvaVentaFormal' => 0,
                            'InformalTotalVenta' => 0,
                            'TotalVenta' => 0,
                        );
                    }
                }
                //acumulador Ventas
                if(is_object($ventas)){
                    foreach ($ventas->getIterator() as $v) {
                        $vmformal += $v->getFormalTotalVenta();
                        $vminformal += $v->getInformalTotalVenta();
                        $vmiva += $v->getTotalIvaVentaFormal();
                    }
                }
                if(is_array($ventas)){
                        $vmformal = 0;
                        $vminformal = 0;
                        $vmiva = 0;
                }
                //GASTOS formales en rango de fechas
                $gastosf = $this->getGastosFormalesByDate($timeline);
                //acumulador Gastos
                foreach ($gastosf->getIterator() as $gf) {
                    $gmformal += $gf->getCostoGasto();
                    $gmiva += ( ($gf->getCostoGasto() / 1.19) * 0.19);
                }
                //GASTOS informales en rango de fechas
                $gastosi = $this->getGastosInformalesByDate($timeline);
                //acumulador Gastos
                foreach ($gastosi->getIterator() as $gi) {
                    $gminformal += $gi->getCostoGasto();
                }

                $acumgf = $this->getGastosFByDate($timeline);
                $acumgi = $this->getGastosIByDate($timeline);

                if ($acumgf->count() > 0) {
                    foreach ($acumgf as $rec => $data) {
                        $fecha = $data['f.FechaPagoGasto'];
                        $cantidad = $data['totalformalGasto'] . "-f";
                        $arrf[$fecha] = $cantidad;
                    }
                }
                if ($acumgf->count() == 0) {
                    $arrf = array($timeline['min']->format('Y-m-d') => '0-f', $timeline['max']->format('Y-m-d') => '0-f');
                }
                if ($acumgi->count() > 0) {
                    foreach ($acumgi as $rec => $data) {
                        $fecha = $data['f.FechaPagoGasto'];
                        $cantidad = $data['informal'] . "-i";
                        $arr[$fecha] = $cantidad;
                    }
                }
                if ($acumgi->count() == 0) {
                    $arr = array($timeline['min']->format('Y-m-d') => '0-f', $timeline['max']->format('Y-m-d') => '0-f');
                }
                //creando array detalle costo
                if (\is_array($arrf) and \is_array($arr)) {
                    $tmparray = array_merge_recursive($arrf, $arr);
                } elseif (\is_array($arrf) and !isset($arr)) {
                    $tmparray = $arrf;
                } elseif (!isset($arrf) and \is_array($arr)) {
                    $tmparray = $arr;
                } else {
                    $tmparray[$timeline['min']->format('Y-m-d')] = array('0-f','0-i');
                    $tmparray[$timeline['max']->format('Y-m-d')] = array('0-f','0-i');
                }
                $i = 0;
                $array = array();
                foreach ($tmparray as $fe => $montos) {
                    $num = \DateTime::createFromFormat('Y-m-d', $fe);
                    if (\sizeof($montos) > 1 and \sizeof($montos) == 2) {
                        $gasto['fechapagogasto'] = $fe;
                        $array = \explode("-", $montos[0]);
                        $gasto['costogasto'] = \floatval($array[0]);
                        unset($array);
                        $array = \explode("-", $montos[1]);
                        $gasto['informal'] = \floatval($array[0]);
                        unset($array);
                    }
                    if (\sizeof($montos) == 1) {
                        $gasto['fechapagogasto'] = $fe;
                        $array = \explode("-", $montos);
                        if ('f' == $array[1]) {
                            $gasto['costogasto'] = \floatval($array[0]);
                            $gasto['informal'] = 0;
                            unset($array);
                        } elseif ('i' == $array[1]) {
                            $gasto['costogasto'] = 0;
                            $gasto['informal'] = \floatval($array[0]);
                            unset($array);
                        }
                    }
                        $i = \intval($num->format('d'));
                        $gastos[$i] = $gasto;
                        unset($num);
                }

                // Calculos Totales
                //GASTOS Totales Formales
                $tfgastos = $this->getAllGastosFormales();
                //acumulador Gastos Formales
                foreach ($tfgastos->getIterator() as $tg) {
                    $gyformal += $tg;
                    $giva += ( ($tg / 1.19) * 0.19);
                }
                //GASTOS Totales Informales
                $tigastos = $this->getAllGastosInformales();
                //acumulador Gastos Informales
                foreach ($tigastos->getIterator() as $tgi)
                    $gyinformal += $tgi;
            }else {
                if($timeline['max'] < $timeline['min']){
                    $error = "Debe corregir las fechas para Generar el Informe.";
                }
                if($intervalo->m >0){
                    $error = "Esta versión, solo permite informes con fechas seleccionadas del mismo mes.";
                }
                return $this->render('CostoSystemBundle:Informe:index.html.twig', array(
            'form' => $form->createView(), 'error' => $error,
                ));
            }
            \array_multisort($gastos);
            // Se vuelve a generar el formulario
            $view = $this->renderView("CostoSystemBundle:Informe:report.html.twig", array(
                        'form' => $form->createView(), 'dates' => $timeline, 'gastos' => $gastos, 'ventas' => $ventas,
                        //primer cuadro
                        //gastos
                        'gyformal' => $gyformal, 'gyinformal' => $gyinformal, 'giva' => $giva,
                        //ventas
                        'vyformal' => $vyformal, 'vyinformal' => $vyinformal, 'viva' => $viva,
                        //segundo cuadro
                        //gastos
                        'gmformal' => $gmformal, 'gminformal' => $gminformal, 'gmiva' => $gmiva,
                        //ventas
                        'vmformal' => $vmformal, 'vminformal' => $vminformal, 'vmiva' => $vmiva
                    ));
            if ('/informe/create' == $request->getPathInfo()) {
                return new Response($view);
            }
            if ('/informe/report' == $request->getPathInfo()) {
                return new Response($this->get('knp_snappy.pdf')->getOutputFromHtml($view),
                        200,
                        array(
                            'Content-Type' => 'application/pdf',
                            'Content-Disposition' => 'attachment; filename="report.pdf"'
                        )
                );
            }
        }
    }

    /**
     * Creador del formulario
     * @return Form
     */
    protected function generateForm() {

        return $this->createFormBuilder(null, array())
                ->add('min_date', 'date', array('label' => 'Desde el día: ', 'input' => 'string', 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'))
                ->add('max_date', 'date', array('label' => ' Hasta el día: ', 'input' => 'string', 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'))
                ->getForm()
        ;
    }

    /**
     * Se recuperan los datos de todas las ventas los campos FormalTotalVenta, InformalTotalVenta, TotalIvaVentaFormal
     * return \PropelArrayCollection tventas
     */
    protected function getAllVentas() {

        return VentaQuery::create('v')
                ->select(array('v.FormalTotalVenta', 'v.InformalTotalVenta', 'v.TotalIvaVentaFormal'))
                ->find();
    }

    /**
     * Se recuperan todos los gastos formales existentes
     * @return \PropelArrayCollection tfgastos
     */
    protected function getAllGastosFormales() {
        return GastoQuery::create('g')
                ->useCuentaQuery('c')
                ->filterByTipoCuenta('FORMAL')
                ->endUse()
                ->select(array('g.CostoGasto'))
                ->find();
    }

    /**
     * Se recuperan todos los gastos informales existentes
     * @return \PropelArrayCollection tigastos
     */
    protected function getAllGastosInformales() {
        return GastoQuery::create('g')
                ->useCuentaQuery('c')
                ->filterByTipoCuenta('INFORMAL')
                ->endUse()
                ->select(array('g.CostoGasto'))
                ->find();
    }

    /**
     * Se recuperan todas las fechas en el rango de fechas
     * @param array $dates
     * @return \PropelObjectCollection ventas
     */
    protected function getVentasByDate($dates) {
        return VentaQuery::create('v')
                ->filterByFechaVenta($dates)
                ->orderByFechaVenta('ASC')
                ->find();
    }

    /**
     * Se recuperan todos los gastos formales por fechas
     * @param array $dates
     * @return \PropelObjectCollection gastosf
     */
    protected function getGastosFormalesByDate($dates) {
        return GastoQuery::create('g')
                ->useCuentaQuery('c', 'INNER JOIN')
                ->filterByTipoCuenta('FORMAL')
                ->endUse()
                ->orderByFechaPagoGasto('ASC')
                ->filterByFechaPagoGasto($dates)
                ->find();
    }

    /**
     * Se recuperan todos los gastos formales por fechas
     * @param array $dates
     * @return \PropelArrayCollection acumf
     */
    protected function getGastosFByDate($dates) {
        return GastoQuery::create('f')
                ->withColumn('SUM(f.CostoGasto)', 'totalformalGasto')
                ->useCuentaQuery('q')
                ->filterByTipoCuenta('FORMAL')
                ->endUse()
                ->filterByFechaPagoGasto($dates)
                ->groupByFechaPagoGasto()
                ->select('f.FechaPagoGasto', 'totalformalGasto')
                ->orderByFechaPagoGasto()
                ->find();
    }

    /**
     * Se recuperan todos los gastos formales por fechas
     * @param array $dates
     * @return \PropelArrayCollection acumi
     */
    protected function getGastosIByDate($dates) {
        return GastoQuery::create('f')
                ->withColumn('SUM(f.CostoGasto)', 'informal')
                ->useCuentaQuery('q')
                ->filterByTipoCuenta('INFORMAL')
                ->endUse()
                ->filterByFechaPagoGasto($dates)
                ->groupByFechaPagoGasto()
                ->select('f.FechaPagoGasto', 'informal')
                ->orderByFechaPagoGasto()
                ->find();
    }

    /**
     * Se recuperan todos los gastos Informales por fechas
     * @param array $dates
     * @return \PropelObjectCollection gastosi
     */
    protected function getGastosInformalesByDate($dates) {
        return GastoQuery::create('g')
                ->useCuentaQuery('c', 'INNER JOIN')
                ->filterByTipoCuenta('INFORMAL')
                ->endUse()
                ->filterByFechaPagoGasto($dates)
                ->orderByFechaPagoGasto('ASC')
                ->find();
    }

    /**
     * Se genera el array de Objetos PHPDateTime
     * @param array $dates
     * @return array
     */
    private function proccessDates($dates) {
        $timelines = array();
        $timelines['min'] = \DateTime::createFromFormat('d/m/Y', $dates['min_date']);
        $timelines['max'] = \DateTime::createFromFormat('d/m/Y', $dates['max_date']);
        return $timelines;
    }

}