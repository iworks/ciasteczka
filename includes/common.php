<?php
/**
 * require
 */
require_once dirname( dirname( __FILE__ )).'/etc/options.php';

$base = dirname(dirname(__FILE__));
$vendor = $base.'/vendor';

require_once $vendor.'/iworks/cookie-policy.php';
/**
 * require: IworksUpprev Class
 */
if ( !class_exists( 'IworksUpprev' ) ) {
    require_once $vendor.'/iworks/upprev.php';
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

