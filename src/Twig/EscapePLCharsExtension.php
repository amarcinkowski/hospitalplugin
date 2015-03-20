<?php
namespace Hospitalplugin\Twig;

class EscapePLCharsExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('escapePL', array(
                $this,
                'escapePLcharsFilter'
            ))
        );
    }

    public function escapePLcharsFilter($string)
    {
        $tabela = Array(
            "Ą" => "A",
            "ą" => "a",
            "Ć" => "C",
            "ć" => "c",
            "Ę" => "E",
            "ę" => "e",
            "Ł" => "L",
            "ł" => "l",
            "Ń" => "N",
            "ń" => "n",
            "Ó" => "O",
            "ó" => "o",
            "Ś" => "S",
            "ś" => "s",
            "Ż" => "Z",
            "ż" => "z",
            "Ź" => "Z",
            "ź" => "z",
            
            // WIN
            
            "xb9" => "a",
            "xa5" => "A",
            "xe6" => "c",
            "xc6" => "C",
            
            "xea" => "e",
            "xca" => "E",
            "xb3" => "l",
            "xa3" => "L",
            
            "xf3" => "o",
            "xd3" => "O",
            "x9c" => "s",
            "x8c" => "S",
            
            "x9f" => "z",
            "xaf" => "Z",
            "xbf" => "z",
            "xac" => "Z",
            
            "xf1" => "n",
            "xd1" => "N",
            
            // UTF
            
            "xc4x85" => "a",
            "xc4x84" => "A",
            "xc4x87" => "c",
            "xc4x86" => "C",
            
            "xc4x99" => "e",
            "xc4x98" => "E",
            "xc5x82" => "l",
            "xc5x81" => "L",
            
            "xc3xb3" => "o",
            "xc3x93" => "O",
            "xc5x9b" => "s",
            "xc5x9a" => "S",
            
            "xc5xbc" => "z",
            "xc5xbb" => "Z",
            "xc5xba" => "z",
            "xc5xb9" => "Z",
            
            "xc5x84" => "n",
            "xc5x83" => "N",
            
            // ISO
            
            "xb1" => "a",
            "xa1" => "A",
            "xe6" => "c",
            "xc6" => "C",
            
            "xea" => "e",
            "xca" => "E",
            "xb3" => "l",
            "xa3" => "L",
            
            "xf3" => "o",
            "xd3" => "O",
            "xb6" => "s",
            "xa6" => "S",
            
            "xbc" => "z",
            "xac" => "Z",
            "xbf" => "z",
            "xaf" => "Z",
            
            "xf1" => "n",
            "xd1" => "N",
            
            // minus hyphen #hash space
            "xc2xad" => "",
            "x2d" => "",
            "x23" => "",
            "x20" => "",
            "&ndash" => "",
            "-" => "",
            "#" => ""
        );
        
        $string = strtr($string, $tabela);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);
        return $string;
    }

    public function getName()
    {
        return 'escape_PL_chars_extension';
    }
}