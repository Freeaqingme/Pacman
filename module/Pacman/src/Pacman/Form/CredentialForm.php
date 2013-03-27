<?php
namespace Pacman\Form;

use Zend\Form\Form;

class CredentialForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('album');
        
        $this->setAttribute('method', 'post');
        $this->add(array(
                'name' => 'id',
                'attributes' => array(
                    'type'    => 'hidden',
                ),
        ));
        
        $this->add(array(
                'name' => 'username',
                'attributes' => array(
                    'type'    => 'text',
                ),
                'options' => array(
                    'label'   => 'Username',
                ),
        ));
        
        $this->add(array(
                'name' => 'url',
                'attributes' => array(
                        'type'    => 'text',
                ),
                'options' => array(
                        'label'   => 'URL',
                ),
        ));
        
        $this->add(array(
                'name' => 'password',
                'attributes' => array(
                        'type'    => 'password',
                ),
                'options' => array(
                        'label'   => 'Password',
                ),
        ));
        
        $this->add(array(
                'name' => 'submit',
                'attributes' => array(
                        'type'  => 'submit',
                        'value' => 'Add',
                        'class' => 'btn',
                        'id' => 'submitbutton',
                ),
        ));
        
    }
    
    
}