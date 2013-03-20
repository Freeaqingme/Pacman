<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model\Credential;

use Pacman\Model\Entity as EntityAbstract;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Entity extends EntityAbstract
{
    /**
     * Credential properties
     * @var array
     */
    protected $inputFilter;
    
    protected $_properties = array(
            'id' => null,
            'project_id' => null,
            'category_id' => null,
            'cluster_id' => null,
            'server_id' => null,
            'notes' => null,
            'url' => null,
            'username' => null,
            'password' => null,
            'submit' => null,
    );
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Input filter is not being used");
    }
    
    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
    
            $inputFilter->add($factory->createInput(array(
                    'name'     => 'id',
                    'required' => true,
                    'filters'  => array(
                            array('name' => 'Int'),
                    ),
            )));
    
            $inputFilter->add($factory->createInput(array(
                    'name'     => 'username',
                    'required' => true,
                    'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                            array(
                                    'name'    => 'StringLength',
                                    'options' => array(
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 100,
                                    ),
                            ),
                    ),
            )));
    
            $inputFilter->add($factory->createInput(array(
                    'name'     => 'password',
                    'required' => true,
                    'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                            array(
                                    'name'    => 'StringLength',
                                    'options' => array(
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 100,
                                    ),
                            ),
                    ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                    'name'     => 'url',
                    'required' => true,
                    'filters'  => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                            array(
                                    'name'    => 'StringLength',
                                    'options' => array(
                                            'encoding' => 'UTF-8',
                                            'min'      => 1,
                                            'max'      => 500,
                                    ),
                            ),
                    ),
            )));
    
            $this->inputFilter = $inputFilter;
        }
    
        return $this->inputFilter;
    }
    
    
}
