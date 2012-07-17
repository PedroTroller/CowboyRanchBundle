<?php

namespace Knp\CowboyRanchBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

/**
 * @author Pierre PLAZANET <pierre.plazanet@knplabs.com>
 **/

class CowType extends AbstractType{
    
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'label' => 'Name of the cow',
        ));
    }
        
    public function getName() 
    {
        return 'knp_cpwboyranchbundle_cow';
    }
    
    public function getDefaultOptions(array $options) {
        return array(
            'data_class' => 'Knp\CowboyRanchBundle\Form\Model\CowAdd'
        );
    }
    
}

