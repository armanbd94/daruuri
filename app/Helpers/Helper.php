<?php
if (!function_exists('permission')) {

    function permission(string $value){
        if (collect(\Illuminate\Support\Facades\Session::get('permissions'))->contains($value)) {
            return true;
        }
        return false;
    }
}

if (!function_exists('read_more')) {

    function read_more($text, $limit = 400){
        $text = $text." ";
        $text = substr($text, 0, $limit);
        $text = substr($text, 0, strrpos($text, ' '));
        $text = $text."...";
        return $text;
    }
}
?>
