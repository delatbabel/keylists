<?php

/**
 * Keytypes model config
 *
 * @link https://github.com/ddpro/admin/blob/master/docs/model-configuration.md
 */

return [

    'title' => 'Keytypes',

    'single' => 'keytype',

    'model'       => '\Delatbabel\Keylists\Models\Keytype',

    /**
     * The display columns
     */
    'columns'     => [
        'id'   => [
            'title' => 'ID',
        ],
        'name'        => [
            'title' => 'Name',
        ],
        'description' => [
            'title' => 'Description',
        ],
    ],

    /**
     * The filter set
     */
    'filters'     => [
        'name' => [
            'title' => 'Name',
        ],
    ],

    /**
     * The editable fields
     */
    'edit_fields' => [
        'name'          => [
            'title' => 'Name',
            'type'  => 'text',
        ],
        'description'   => [
            'title' => 'Description',
            'type'  => 'text',
        ],
        'extended_data' => [
            'title'  => 'Extended Data',
            'type'   => 'json',
            'height' => '400',
        ],
    ],

    'form_width' => 700,
];
