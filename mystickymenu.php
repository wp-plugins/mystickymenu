<?php     
   /*
    Plugin Name: myStickymenu 
    Plugin URI: http://wordpress.transformnews.com/plugins/mystickymenu-simple-sticky-fixed-on-top-menu-implementation-for-twentythirteen-menu-269
    Description: Simple sticky (fixed on top) menu implementation for default Twentythirteen navigation menu. For other themes, after install go to Settings / myStickymenu and change navigation class to .your_navbar_class or #your_navbar_id.
    Version: 1.2
    Author: m.r.d.a
    License: GPLv2 or later
    */

// add plugin admin settings by otto
class MyStickyMenuPage
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
		add_action( 'admin_init', array( $this, 'mysticky_default_options' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
		
        add_options_page(
            'Settings Admin', 
            'myStickymenu', 
            'manage_options', 
            'my-stickymenu-settings', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'mysticky_option_name');
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>myStickymenu Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'mysticky_option_group' );   
                do_settings_sections( 'my-stickymenu-settings' );
                submit_button(); 
            ?>
            </form>
        </div>
        <?php
    }
	
/**
     * Load Defaults
     */ 	
	public function mysticky_default_options() {
		
		global $options;

		if ( false ===  get_option('mysticky_option_name')  ) {

			$default = array(

				'mysticky_class_selector' => '.navbar',
				'myfixed_zindex' => '1000000',
				'myfixed_width' => '',
				'myfixed_bgcolor' => '#F39A30',
				'myfixed_opacity' => '95',
				'myfixed_transition_time' => '0.3',

			);

			add_option( 'mysticky_option_name', $default );
		}
	}

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'mysticky_option_group', // Option group
            'mysticky_option_name', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );
		
		add_settings_field( $id, $title, $callback, $page, $section = 'default', $args = array() );

        add_settings_section(
            'setting_section_id', // ID
            'myStickymenu Options', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-stickymenu-settings' // Page
        );

        add_settings_field(
            'mysticky_class_selector', // ID
            'mySticky Class', // Title 
            array( $this, 'mysticky_class_selector_callback' ), // Callback
            'my-stickymenu-settings', // Page
            'setting_section_id' // Section         
        );

        add_settings_field(
            'myfixed_zindex', 
            'mySticky z-index', 
            array( $this, 'myfixed_zindex_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		 add_settings_field(
            'myfixed_width', 
            'mySticky Width', 
            array( $this, 'myfixed_width_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        ); 
		
		add_settings_field(
            'myfixed_bgcolor', 
            'mySticky Background Color', 
            array( $this, 'myfixed_bgcolor_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		add_settings_field(
            'myfixed_opacity', 
            'Sticky Opacity', 
            array( $this, 'myfixed_opacity_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		add_settings_field(
            'myfixed_transition_time', 
            'mySticky Transition Time', 
            array( $this, 'myfixed_transition_time_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['mysticky_class_selector'] ) )
            $new_input['mysticky_class_selector'] = sanitize_text_field( $input['mysticky_class_selector'] );

        if( isset( $input['myfixed_zindex'] ) )
            $new_input['myfixed_zindex'] = absint( $input['myfixed_zindex'] );
			
		if( isset( $input['myfixed_width'] ) )
            $new_input['myfixed_width'] = sanitize_text_field( $input['myfixed_width'] );
			
		if( isset( $input['myfixed_bgcolor'] ) )
            $new_input['myfixed_bgcolor'] = sanitize_text_field( $input['myfixed_bgcolor'] );
			
		if( isset( $input['myfixed_opacity'] ) )
            $new_input['myfixed_opacity'] = sanitize_text_field( $input['myfixed_opacity'] );
			
		if( isset( $input['myfixed_transition_time'] ) )
            $new_input['myfixed_transition_time'] = sanitize_text_field( $input['myfixed_transition_time'] );	

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Change mySticky options to suite your needs';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function mysticky_class_selector_callback()
    {
        printf(
            '<input type="text" id="mysticky_class_selector" name="mysticky_option_name[mysticky_class_selector]" value="%s" /> .navbar for Twenty Thirteen template, for other templates inspect your code to find apropriate menu/navigation bar class or id.',
            isset( $this->options['mysticky_class_selector'] ) ? esc_attr( $this->options['mysticky_class_selector']) : '' 
        );
    }

    /** 
     * Get the settings option array and print one of its values*/
    
    public function myfixed_zindex_callback()
    {
        printf(
            '<input type="text" id="myfixed_zindex" name="mysticky_option_name[myfixed_zindex]" value="%s" /> sticky z-index, default 1000000',
            isset( $this->options['myfixed_zindex'] ) ? esc_attr( $this->options['myfixed_zindex']) : ''
        );
    }
	
	public function myfixed_width_callback()
    {
        printf(
            '<input type="text" id="myfixed_width" name="mysticky_option_name[myfixed_width]" value="%s" /> sticky width in px or percentage, leave empty for default' ,
            isset( $this->options['myfixed_width'] ) ? esc_attr( $this->options['myfixed_width']) : ''
        );
    }
	
	public function myfixed_bgcolor_callback()
    {
        printf(
            '<input type="text" id="myfixed_bgcolor" name="mysticky_option_name[myfixed_bgcolor]" value="%s" /> default #F39A30' ,
            isset( $this->options['myfixed_bgcolor'] ) ? esc_attr( $this->options['myfixed_bgcolor']) : ''
        );
    }
	
	public function myfixed_opacity_callback()
    {
        printf(
            '<input type="text" id="myfixed_opacity" name="mysticky_option_name[myfixed_opacity]" value="%s" /> numbers 1-100, default 95',
            isset( $this->options['myfixed_opacity'] ) ? esc_attr( $this->options['myfixed_opacity']) : ''
        );
    }
	
	public function myfixed_transition_time_callback()
    {
        printf(
            '<input type="text" id="myfixed_transition_time" name="mysticky_option_name[myfixed_transition_time]" value="%s" /> in seconds, default 0.3',
            isset( $this->options['myfixed_transition_time'] ) ? esc_attr( $this->options['myfixed_transition_time']) : ''
        );
    }	
	 
}

if( is_admin() )
    $my_settings_page = new MyStickyMenuPage();

// end plugin admin settings


// remove default option for more link that jumps at the midle of page and its covered by menu

function mysticky_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'mysticky_remove_more_jump_link');

// create style from options

function mysticky_build_stylesheet_content() {
	$mysticky_options = get_option( 'mysticky_option_name' );
    echo '
    <style type="text/css">
	#wpadminbar {
		position: absolute !important;
		top: 0px !important;
		}
	.myfixed {
		position: fixed ;
		top: 0px;
		z-index: '. $mysticky_options ['myfixed_zindex'] .'; 
		-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=' . $mysticky_options ['myfixed_opacity'] . ')";
		filter: alpha(opacity=' . $mysticky_options ['myfixed_opacity'] . ');
		opacity:.' . $mysticky_options ['myfixed_opacity'] . ';
		width:' . $mysticky_options ['myfixed_width'] . ';
		background-color: '. $mysticky_options ['myfixed_bgcolor'] . ';
		-webkit-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;
		-moz-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;
		-o-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;
		transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;
		}
</style>
';
    
}
add_action('wp_head', 'mysticky_build_stylesheet_content');
	
	
function mystickymenu_script() {
		
// options on frontpage
		$mysticky_options = get_option( 'mysticky_option_name' );
		
// register scripts
wp_register_script('mystickymenu', WP_PLUGIN_URL. '/mystickymenu/mystickymenu.js', false,'1.0.0', true);
wp_enqueue_script( 'mystickymenu' );

// Localize mystickymenu.js script with myStickymenu options
		$mysticky_translation_array = array( 'mysticky_string' => $mysticky_options['mysticky_class_selector'] );
		
wp_localize_script( 'mystickymenu', 'mysticky_name', $mysticky_translation_array );

}
add_action( 'wp_enqueue_scripts', 'mystickymenu_script' );

?>