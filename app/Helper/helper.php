<?php

use App\Type;

if (!function_exists('type_options')) {
    function type_options($id = 0) {
        $options = "";
        $types = Type::all();
        foreach($types as $t) {
            if($id === $t->id) {
                $options .= "<option value=\"$t->id\" selected>$t->name</option>";
            } else {
                $options .= "<option value=\"$t->id\">$t->name</option>";
            }
        }
        return $options;
    }
}

?>
