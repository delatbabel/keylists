<?php

/**
 * Keytypes model config
 *
 * @link https://github.com/ddpro/admin/blob/master/docs/model-configuration.md
 */

return array(

    'title' => 'Keytypes',

    'single' => 'keytype',

    'model' => '\Delatbabel\Keylists\Models\Keytype',

    /**
     * The display columns
     */
    'columns' => array(
        'id',
        'name' => array(
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
        'name' => array(
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
