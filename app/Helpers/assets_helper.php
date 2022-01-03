<?php
if (!function_exists('css_url')) {
    function css_url($nom)
    {
        return base_url() . '/assets/css/' . $nom . '.css';
    }
}

if (!function_exists('js_url')) {
    function js_url($nom)
    {
        return base_url() . '/assets/js/' . $nom . '.js';
    }
}

if (!function_exists('img_url')) {
    function img_url($nom)
    {
        return base_url() . '/assets/images/' . $nom;
    }
}

if (!function_exists('img')) {
    function img($nom, $alt = '')
    {
        return '<img src="' . img_url($nom) . '" alt="' . $alt . '" />';
    }
}

if (!function_exists('img_class')) {
    function img_class($nom, $alt = '', $class = '')
    {
        return '<img class="' . $class . '" src="' . img_url($nom) . '" alt="' . $alt . '" />';
    }
}

if (!function_exists('php_url')) {
    function php_url($nom)
    {
        return base_url() . '/assets/php/' . $nom;
    }
}
