<?php

function iworks_icp_options()
{
    $iworks_icp_options = array();

    /**
     * main settings
     */
    $iworks_icp_options['index'] = array(
        'use_tabs' => false,
        'version'  => '0.0',
        'options'  => array(
            array(
                'name'              => 'status',
                'type'              => 'checkbox',
                'th'                => __( 'Status', 'icp' ),
                'label'             => __( 'Display cookie policy message.', 'icp' ),
                'default'           => 0,
                'sanitize_callback' => 'absint'
            ),
            array(
                'name'              => 'url',
                'type'              => 'text',
                'class'             => 'large-text',
                'th'                => __( 'COP url', 'icp' ),
            ),
            array(
                'name'              => 'selector',
                'type'              => 'text',
                'class'             => 'large-text',
                'th'                => __( 'jQuery selector', 'icp' ),
                'default'           => 'body',
                'description' => __( 'jQuery selector to append COP message.', 'icp' )
            ),
            array(
                'name'              => 'text',
                'type'              => 'textarea',
                'class'             => 'large-text',
                'th'                => __( 'COP text', 'icp' ),
                'default'           => '<p  style="border:1px solid #666;margin:10px;padding:10px;">Niniejsza strona internetowa korzysta z plików cookie. Pozostając na tej stronie wyrażasz zgodę na korzystanie z plików cookie. Dowiedz się więcej <a href="%URL%" rel="nofollow">%URL%</a>.</p>',
                'description' => __( 'Use %URL% to put COP url.', 'icp' )
            ),
        )
    );
    return $iworks_icp_options;
}

