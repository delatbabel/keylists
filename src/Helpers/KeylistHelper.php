<?php

namespace Delatbabel\Keylists\Helpers;

class KeylistHelper {
    public static function filterByKeytypeName($query, $name) {
        $obj = \Delatbabel\Keylists\Models\Keytype::where('name', $name)->first();
        if ($obj) {
            $query->where('keytype_id', $obj->id);
        } else {
            // Force the query return null
            $query->where('keytype_id', 0);
        }
    }
}