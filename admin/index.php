<div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php _e( 'Cookie Policy', 'icp') ?></h2>
    <form method="post" action="options.php" id="iworks_icp_admin_index">
<?php
$option_name = basename( __FILE__, '.php');
$iworks_icp_options->settings_fields( $option_name );
$iworks_icp_options->build_options( $option_name );
?>
    </form>
</div>

