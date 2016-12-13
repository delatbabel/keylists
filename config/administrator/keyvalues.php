<?php

/**
 * Keyvalues model config
 *
 * @link https://github.com/ddpro/admin/blob/master/docs/model-configuration.md
 */

return [
    'title' => 'Keyvalues',
    'single' => 'keyvalue',
    'model' => '\Delatbabel\Keylists\Models\Keyvalue',
    'server_side'  => true,

    /**
     * The display columns
     */
    'columns' => [
        'id',
        'keytype' => [

            'title'         => 'Key Type',
            'type'          => 'relationship',
            'relationship'  => 'keytype',
            'select'        => "(:table).name",
        ],
        'keyvalue' => [
            'title' => 'Value',
        ],
        'keyname' => [
            'title' => 'Name',
        ],
        'description' => [
            'title' => 'Description',
        ],
    ],

    /**
     * The filter set
     */
    'filters' => [
        'keytype'    => [
            'title'      => 'Type',
            'type'       => 'relationship',
            'name_field' => 'name',
        ],
        'keyname' => [
            'title' => 'Name',
        ],
    ],

    /**
     * The editable fields
     */
    'edit_fields' => [
        'keytype' => [
            'title'      => 'Key Type',
            'type'       => 'relationship',
            'name_field' => 'name',
        ],
        'keyvalue' => [
            'title' => 'Value',
            'type'  => 'text',
        ],
        'keyname' => [
            'title' => 'Name',
            'type'  => 'text',
        ],
        'description' => [
            'title' => 'Description',
            'type'  => 'text',
        ],
        'extended_data' => [
            'title' => 'Extended Data',
            'type'  => 'json',
            'height' => '400',
        ],
    ],

    'form_width' => 700,
];
