<?php
/**
 * Pacman (https://github.com/Enrise/Pacman)
 * @link https://github.com/Enrise/Pacman for the canonical source repository
 * @copyright Copyright (c) 2012 Enrise (www.enrise.com)
 * @license http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pacman\Model;

abstract class Entity
{
    /**
     * Entity properties
     * @var array
     */
    protected $_properties = array();

    /**
     * Properties that have been set
     * @var array
     */
    protected $_propertiesSet = array();

    /**
     * autoCamelCase methods and properties
     * @var boolean
     */
    protected $camelCase = true;

    public function __call($method, $params)
    {
        $key = lcfirst(substr($method, 3));

        $action = substr($method, 0, 3);
        if ($action == 'get') {
            return $this->_get($this->stringFromCamelCase($key));

        } elseif ($action == 'set') {
            if ($this->camelCase && strpos($method, '_')) {
                throw new \RuntimeException(
                   'You should set the property ' . $key
                 . ' using ' . $this->getSetterForKey($key) . '()'
                );
            }

            $this->_set($this->stringFromCamelCase($key), reset($params));

        } else {
            throw new \BadMethodCallException('Invalid method tried to call');
        }

        return $this;
    }

    protected function _set($key, $value)
    {
        if (!array_key_exists($key, $this->_properties)) {
            throw new \Exception('Invalid property was tried to set: ' . $key);
        }

        $this->_properties[$key] = $value;
        $this->_propertiesSet[$key] = true;

        return $this;
    }

    public function __get($key)
    {
        return $this->{'get' . ucfirst($key)}();
    }

    protected function _get($key)
    {
        if (!array_key_exists($key, $this->_properties)) {
            throw new \Exception('Invalid key was tried to get: ' . $key);
        }

        return $this->_properties[$key];
    }

    /**
     * Set entity properties
     *
     * @param array $properties
     * @param bool $complementOnly
     */
    public function exchangeArray($properties, $complementOnly = false)
    {
        foreach($properties as $key => $value) {
            if (false == $complementOnly ||
                !$this->isPropertySet($key, false)
            ) {
                $this->{$this->getSetterForKey($key)}($value);
            }
        }
    }

    /**
     * Get all properties from this entity as an array
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->_properties;
    }

    /**
     * Check if property is set
     * @param string $key
     * @param bool $throwException
     * @throws Exception
     * @return boolean
     */
    public function isPropertySet($key, $throwException = true)
    {
        if ($throwException && !array_key_exists($key, $this->_properties)) {
            throw new \Exception('An unknown property was tried to retrieve: ' . $key);
        }

        return array_key_exists($key, $this->_propertiesSet) && $this->_propertiesSet[$key];
    }

    /**
     * Convert from camelCase to the underscored counterpart
     *
     * Does nothing if $this->camelCase is set to false
     *
     * @param string $str
     * @return string
     */
    protected function stringFromCamelCase($str)
    {
        if (!$this->camelCase) {
            return $str;
        }

        return strtolower(preg_replace('/([^A-Z])([A-Z])/', "$1_$2", $str));
    }

    /**
     * Convert the given key to the appropriate naming convention.
     *
     * @param string $key
     * @param boolean $camelCase (optional) Should go to camelCase, or not.
     * @return string
     */
    protected function getSetterForKey($key, $camelCase = null)
    {
        if ($camelCase === null) {
            $camelCase = $this->camelCase;
        }

        if ($camelCase) {
            $key = preg_replace('/_(.?)/e', "strtoupper('$1')", $key);
        }

        return 'set' . ucfirst($key);
    }
}
