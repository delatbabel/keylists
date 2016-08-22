<?php

/**
 * Keyvalues model config
 *
 * @link https://github.com/ddpro/admin/blob/master/docs/model-configuration.md
 */

return array(

    'title' => 'Keyvalues',

    'single' => 'keyvalue',

    'model' => '\Delatbabel\Keylists\Models\Keyvalue',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'keyvalue' => array(
            'title' => 'Value',
        ),
        'keyname' => array(
            'title' => 'Name',
        ),
        'description' => array(
            'title' => 'Description',
        ),
    ),

    /**
     * The filter set
     */
    'filters' => array(
        'name' => array(
            'title' => 'Name',
        ),
    ),

    /**
     * The editable fields
     */
    'edit_fields' => array(
        'keytype' => array(
            'title' => 'Key Type',
            'type' => 'relationship',
            'name_field' => 'name',
        ),
        'keyvalue' => array(
            'title' => 'Value',
            'type' => 'text',
        ),
        'keyname' => array(
            'title' => 'Name',
            'type' => 'text',
        ),
        'description' => array(
            'title' => 'Description',
            'type' => 'text',
        ),
        'extended_data' => array(
            'title' => 'Extended Data',
            'type' => 'textarea',
        ),
    ),

    'form_width' => 700,
);
