<?php 
/**
* User settings for V2Plugin
*/
//Hook Options Menu Initialization
add_action('admin_init', 'V2Plugin_admin_init');
//hook the function that adds our settings page to the admin menu
add_action( 'admin_menu', 'V2Plugin_menu' );
//Initialize Plugin
function V2Plugin_admin_init(){
register_setting( 'V2Plugin_plugin_options', 'V2Plugin_plugin_options', 'V2Plugin_plugin_options_validate');
add_settings_section('V2Plugin_Settings', 'Vision2 Settings', 'V2Plugin_Settings_Text', 'Vision2');
add_settings_field('V2Plugin_API_URL', 'Vision2 API URL', 'V2Plugin_API_URL_Text', 'Vision2', 'V2Plugin_Settings');
}
//Add Vision2 Settings menu to Wordpress admin menu for administrators, create the page "V2Settings.php"
function V2Plugin_menu() {
	add_options_page( 'Vision2 Settings', 'Vision2 Settings', 'administrator', 'V2Settings.php', 'V2Plugin_Settings' );
}
function V2Plugin_Settings_Text() {
 echo "This page is used to set global Wordpress settings for Vision2";
}
function V2Plugin_API_URL_Text() {
	//retrieve current V2Plugin_plugin_options settings set by user, if any
	$options = get_option('V2Plugin_plugin_options');
	//instructions
	echo "<h3>Vision2 API URL</h3><p><b>Required Field.</b> Please enter the subdomain of your Vision2 API. For example: https://<b>subdomiain</b>.V2sapi.co";
	//input (with current outputs already displayed)
	echo "<input id='V2Plugin_API_URL' name='V2Plugin_plugin_options[V2Plugin_API_URL]' type='text' value='{$options['V2Plugin_API_URL']}' />";
}
//Validate if a V2 site
// validate our fields before updating options.php
function V2Plugin_plugin_options_validate($input) {
//Can only be alphanumeric
if(ctype_alnum($input['V2Plugin_API_URL'])) {
	//set output variable to our input values
	$output = $input;
}
else
		{
		//Invalid tracking code: set error
		add_settings_error( 'V2Plugin_plugin_options', false, 'The subdomain must be alphanumeric and cannot contain symbols.', 'error' );
		//return original values, discard changes
return get_option('V2Plugin_plugin_options');
		}

	return $output;
}
//This function echoes the option sections and fields for Vision2 Settings. V2Plugin_menu() calls this function using add_options_page
function V2Plugin_Settings() {
	?>
    <div class="wrap">
    <h2>Vision2 Settings</h2>
    <form method="post" action="options.php">
    <?php settings_fields( 'V2Plugin_plugin_options' ); ?>
    <?php do_settings_sections( 'Vision2' ); ?>
    <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
    </form>
    </div>
<?php
}
add_action('admin_notices', 'Vision2_admin_notice');
function Vision2_admin_notice() {
	$Vision2_options = get_option('V2Plugin_plugin_options');
        /* Check that the user hasn't already clicked to ignore the message */
	if (!isset($V2Plugin_options['V2Plugin_API_URL' ] )) {
        echo '<div class="updated"><p>';
        echo 'Vision2 is not ready. <a href="options-general.php?page=V2Settings.php">update add you Vision2 API URL</a>.';
        echo "</p></div>";
	}
}
?>