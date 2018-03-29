<?php

function settings($index = null, $new_value = null) {
    if ($new_value != null) {
        $conf = \App\Setting::where('index', $index)->first();
        if ($conf) {
            $conf->value = $new_value;
            $conf->save();

            return $conf->value;
        }
    }

    if ($index != null) {
        return \App\Setting::get($index);
    }

    return \App\Setting::getAllAsArray();
}