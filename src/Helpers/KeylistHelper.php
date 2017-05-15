<?php

namespace Delatbabel\Keylists\Helpers;

class KeylistHelper {
    public static function filterByKeytypeName($query, $name) {
        $query->where(
            'keytype_id', \Delatbabel\Keylists\Models\Keytype::where('name', $name)->first()->id
        );
    }
}