<?php

namespace Costo\SystemBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VentaType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {
        $builder
                ->add('fecha_venta', 'date', array(
                    'label' => 'Fecha Venta',
                    'widget' => 'single_text',
                    'input' => 'datetime',
                    'format' => 'dd/MM/yyyy'
                        )
                )
                ->add('total_venta', 'money', array(
                    'label' => 'Total Venta',
                    'currency' => 'CLP',
                    'precision' => 0,
//                    'grouping' => true
                        )
                )
                ->add('formal_total_venta', 'money', array(
                    'label' => 'V. Formal',
                    'currency' => 'CLP',
                    'precision' => 0,
//                    'grouping' => true
                        )
                )
                ->add('informal_total_venta', 'money', array(
                    'label' => 'V. Informal',
                    'currency' => 'CLP',
                    'precision' => 0,
//                    'grouping' => true
                        )
                )
                ->add('total_iva_venta_formal', 'money', array(
                    'label' => 'I.V.A',
                    'currency' => 'CLP',
                    'precision' => 0,
//                    'grouping' => true
                        )
                )
                ->add('detalle_venta', 'textarea', array('label' => 'Detalle'))
        ;
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Costo\SystemBundle\Model\Venta',
        );
    }

    public function getName() {
        return 'venta';
    }

}
