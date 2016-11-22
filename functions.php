<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

add_action('admin_menu', 'under_maintenance_options_menu');

function under_maintenance_options_menu() {
    add_submenu_page('themes.php',
    'UnderMaintenance', 'Settings', 'manage_options',
    'under-maintenance', 'under_maintenance_options_page');
    //add_menu_page('Theme Options', 'Theme Options', 'administrator', __FILE__, 'under_maintenance_options_page' );
    
    add_action( 'admin_init', 'under_maintenance_options_settings' );
}

function under_maintenance_options_page() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
    
    if (isset($_POST['submit'])) {
        $contact_email = sanitize_text_field($_POST['contact_email']);
        update_option('contact_email',$contact_email);
    }
?>
<div class="wrap">
<h1>Theme Options</h1>

<form method="post">
    <?php settings_fields( 'under-maintenance-settings-group' ); ?>
    <?php do_settings_sections( 'under-maintenance-settings-group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Contact Email</th>
        <td><input type="email" name="contact_email" value="<?php echo esc_attr( get_option('contact_email') ); ?>" /></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php
}

function under_maintenance_options_settings() {
    register_setting( 'under-maintenance-settings-group', 'contact_email' );
}
?>