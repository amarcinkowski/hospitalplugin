<?php
namespace Hospitalplugin\Entities;

class PatientFactory
{

    public static function build($type)
    {
        $type = 'Hospitalplugin\Entities\Patient' . $type;
        if (class_exists($type)) {
            return new $type();
        } else {
            throw new Exception("Invalid type given.");
        }
    }
}