<?php

/*

Copyright 2013-2013 Marcin Pietrzak (marcin@iworks.pl)

this program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

 */

if ( !defined( 'WPINC' ) ) {
    die;
}

if ( class_exists( 'Iworks_Cookie_Policy' ) ) {
    return;
}

class Iworks_Cookie_Policy
{

    private static $dir;
    private static $capability;
    private $options;

    public function __construct()
    {
        $this->dir = basename( dirname( dirname( __FILE__ ) ) );
        $this->capability = apply_filters( 'iworks_icp_capability', 'manage_options' );
        /**
         * actions
         */
        add_action( 'admin_init', 'iworks_icp_options_init' );
        add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
        add_action( 'wp_enqueue_scripts', array( &$this, 'wp_enqueue_scripts' ) );
        add_action( 'wp_footer', array( &$this, 'wp_footer' ) );
        /**
         * global option object
         */
        global $iworks_icp_options;
        $this->options = $iworks_icp_options;
    }

    private function status()
    {
        return 1 == $this->options->get_option( 'status' );
    }

    public function wp_enqueue_scripts()
    {
        if ( !$this->status() ) {
            return;
        }
        wp_enqueue_script( 'jquery' );
    }

    /**
     * Add page to theme menu
     */
    public function admin_menu()
    {
        $page = add_options_page(
            __( 'Cookie Policy', 'icp' ),
            __( 'Cookie Policy', 'icp' ),
            $this->capability,
            $this->dir.'/admin/index.php'
        );
        add_action( 'admin_print_scripts-' . $page, 'iworks_icp_admin_print_scripts' );
    }

    public function wp_footer()
    {
        if ( !$this->status() ) {
            return;
        }
?>
<script type="text/javascript">
jQuery( function($) {
$(document).ready( function() {
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
    if ( readCookie( 'cop' ) ) {
        createCookie( 'cop', 1, 30 );
        return;
    }
    html = '<div id="cop"><?php
        $html = $this->options->get_option( 'text' );
        $html = preg_replace( '/\'/', "\'", $html );
        echo preg_replace( '/%URL%/', $this->options->get_option( 'url' ), $html );
    ?></div>';
    el = $('<?php echo $this->options->get_option( 'selector' ); ?>');
    if ( !el ) {
        el = $('body');
    }
    el.prepend(html);
    createCookie( 'cop', 1, 30 );
});
});
</script>
<?php
    }

}

