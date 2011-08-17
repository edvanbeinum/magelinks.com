<?php
/**
 *
 * @author Ed van Beinum <edwin@sessiondigital.com>
 * @version $Id$
 * @copyright Ibuildings 14/08/2011
 * @package Magelinks_Twig_Extension
 */


/**
 *
 * @package Magelinks_Twig_Extension
 * @author Ed van Beinum <edwin@sessiondigital.com>
 */
class Magelinks_Twig_Extension extends Twig_Extension
{

    public function getName()
    {
        return 'Magelinks_Twig_Extension';
    }

    public function getFilters()
    {
        return array(
            'limitChars' => new Twig_Filter_Method($this, 'limitChars'),
            'var_dump' => new Twig_Filter_Function('var_dump')
        );
    }

    /**
     * Limits a phrase to a given number of characters.
     *
     *
     * @param string $str phrase to limit characters of
     * @param integer $limit number of characters to limit to
     * @param string  $end_char end character or entity
     * @param boolean $preserve_words enable or disable the preservation of words while limiting
     * @return string
     */
    public static function limitChars($str, $limit = 100, $end_char = NULL, $preserve_words = FALSE)
    {
        $end_char = ($end_char === NULL) ? '…' : $end_char;

        $limit = (int)$limit;

        if (trim($str) === '' OR strlen($str) <= $limit)
            return $str;

        if ($limit <= 0)
            return $end_char;

        if ($preserve_words === FALSE)
            return rtrim(substr($str, 0, $limit)) . $end_char;

        // Don't preserve words. The limit is considered the top limit.
        // No strings with a length longer than $limit should be returned.
        if (!preg_match('/^.{0,' . $limit . '}\s/us', $str, $matches))
            return $end_char;

        return rtrim($matches[0]) . ((strlen($matches[0]) === strlen($str)) ? '' : $end_char);
    }
}
