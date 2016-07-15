<?php

namespace Costo\SystemBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CuentaType extends AbstractType {

    public function buildForm(FormBuilder $builder, array $options) {

        $builder->add('nombre_cuenta', 'text', array('label'  => 'Cuenta',));
        $builder->add('valor_cuenta', 'money', array(
            'label'  => 'Valor',
            'currency'=>'CLP',
            'precision' => 0,
            'read_only' => true,
            ));
        $builder->add('tipo_cuenta', 'choice',
                array(
                    'label'  => 'Tipo',
                    'choices' => array('FORMAL' => 'Formal', 'INFORMAL' => 'Informal'),
                    'required' => true,
        ));
    }

    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Costo\SystemBundle\Model\Cuenta',
        );
    }

    public function getName() {
        return 'cuenta';
    }

}
