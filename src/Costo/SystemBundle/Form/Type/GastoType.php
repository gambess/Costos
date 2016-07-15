<?php

namespace Costo\SystemBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Costo\SystemBundle\Model\CuentaQuery;

class GastoType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {

        $builder->add('cuenta', 'model',
                array(
                    'label' => 'Cuenta',
                    'class' => 'Costo\SystemBundle\Model\Cuenta',
                    'property' => 'NombreCuenta',
        ));
        $builder->add('nombre_gasto', 'text', array('label' => 'Gasto',));
        $builder->add('costo_gasto', 'money', array(
            'label' => 'Costo',
            'currency'=>'CLP',
            'precision' => 0,
            ));
        $builder->add('fecha_emision_gasto', 'date', array(
            'label' => 'F. Emisión',
            'widget' => 'single_text',
            'input' => 'datetime',
            'format' => 'dd/MM/yyyy'
                )
        );
        $builder->add('fecha_pago_gasto', 'date', array(
            'label' => 'F. Pago',
            'widget' => 'single_text',
            'input' => 'datetime',
            'format' => 'dd/MM/yyyy'
            ));
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Costo\SystemBundle\Model\Gasto',
        );
    }

    public function getName() {
        return 'gasto';
    }

}
