<?php
namespace Hospitalplugin\Twig;

class GetPropertiesExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('props', array(
                $this,
                'getPropsFilter'
            ))
        );
    }

    /**
     * return props of a class
     * @param unknown $class
     * @return boolean|multitype:
     */
    private static function getProps($class)
    {
        if ($class == NULL) {
            return array();
        }
        $class = new \ReflectionClass($class);
        $properties = array_filter($class->getProperties(), function ($prop) use($class)
        {
            return $prop->getDeclaringClass()->name == $class->name;
        });
        return $properties;
    }

    private static function exludeAndReplace($properties, $exclude, $replace, $titles)
    {
        $propsArray = [];
        foreach ($properties as $value) {
            if (in_array($value->name, $exclude)) {
                continue;
            }
            if (array_key_exists($value->name, $replace)) {
                $name = $replace[$value->name];
            } else {
                $name = $value->name;
            }
            if (array_key_exists($value->name, $titles)) {
                $title = $titles[$value->name];
            } else {
                $title = strtoupper(substr($name, 0, 1));
            }
            array_push($propsArray, array(
                'data' => $name,
                'title' => $title
            ));
        }
        return $propsArray;
    }

    /**
     * returns properties of an object excluding those that have name same as in $exclude array
     * 
     * order of returned properties is: first parent class of $obj props then base class props of an $obj
     * 
     * @param unknown $obj
     * @param unknown $exclude
     * @return boolean|string
     */
    public function getPropsFilter($obj, $exclude, $replace, $titles)
    {
        // properties of an object, not array
        while (is_array($obj)) {
            $obj = $obj[0];
        }
        $parentProperties = GetPropertiesExtension::getProps(get_parent_class($obj));
        $properties = GetPropertiesExtension::getProps($obj);
        $propertiesMerged = array_merge($parentProperties, $properties);
        $propsArray = GetPropertiesExtension::exludeAndReplace($propertiesMerged, $exclude, $replace, $titles);
        return $propsArray;
    }

    public function getName()
    {
        return 'get_properties_extension';
    }
}