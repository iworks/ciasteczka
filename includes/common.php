<?php
/**
 * require
 */
require_once dirname( __FILE__ ).'/class-iworks-cookie-policy.php';
require_once dirname( dirname( __FILE__ )).'/etc/options.php';
/**
 * IworksOptions Class
 */
if ( !class_exists( 'IworksOptions' ) ) {
    require_once dirname( __FILE__ ).'/class-iworks-options.php';
}

/**
 * i18n
 */
load_plugin_textdomain( 'icp', false, dirname( dirname( plugin_basename( __FILE__) ) ).'/languages' );

/**
 * load options
 */
$iworks_icp_options = new IworksOptions();
$iworks_icp_options->set_option_function_name( 'iworks_icp_options' );
$iworks_icp_options->set_option_prefix( IWORKS_ICP_PREFIX );

function iworks_icp_options_init()
{
    global $iworks_icp_options;
    $iworks_icp_options->options_init();
}

function iworks_icp_activate()
{
    $iworks_icp_options = new IworksOptions();
    $iworks_icp_options->set_option_function_name( 'iworks_icp_options' );
    $iworks_icp_options->set_option_prefix( IWORKS_ICP_PREFIX );
    $iworks_icp_options->activate();
}

function iworks_icp_deactivate()
{
    global $iworks_icp_options;
    $iworks_icp_options->deactivate();
}

