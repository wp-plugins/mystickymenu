<?php     
   /*
    Plugin Name: myStickymenu 
    Plugin URI: http://wordpress.transformnews.com/plugins/mystickymenu-simple-sticky-fixed-on-top-menu-implementation-for-twentythirteen-menu-269
    Description: Simple sticky (fixed on top) menu implementation for default Twentythirteen navigation menu. For other themes, after install go to Settings / myStickymenu and change Sticky Class to .your_navbar_class or #your_navbar_id.
    Version: 1.6
    Author: m.r.d.a
    License: GPLv2 or later
    */
// Block direct acess to the file
defined('ABSPATH') or die("Cannot access pages directly.");

// Add plugin admin settings by Otto
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
     * Register and add settings
     */
    public function page_init()
    {   
		global $id, $title, $callback, $page;     
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
            'Sticky Class', // Title 
            array( $this, 'mysticky_class_selector_callback' ), // Callback
            'my-stickymenu-settings', // Page
            'setting_section_id' // Section         
        );

        add_settings_field(
            'myfixed_zindex', 
            'Sticky z-index', 
            array( $this, 'myfixed_zindex_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		add_settings_field(
            'myfixed_bgcolor', 
            'Sticky Background Color', 
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
            'Sticky Transition Time', 
            array( $this, 'myfixed_transition_time_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		add_settings_field(
            'myfixed_disable_small_screen', 
            'Disable at Small Screen Sizes', 
            array( $this, 'myfixed_disable_small_screen_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		add_settings_field(
            'mysticky_active_on_height', 
            'Make visible when scroled', 
            array( $this, 'mysticky_active_on_height_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );
		
		add_settings_field(
            'myfixed_fade', 
            'Fade or slide effect', 
            array( $this, 'myfixed_fade_callback' ), 
            'my-stickymenu-settings', 
            'setting_section_id'
        );	
		
		add_settings_field(
            'myfixed_cssstyle', 
            '.myfixed css class', 
            array( $this, 'myfixed_cssstyle_callback' ), 
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
			
		if( isset( $input['myfixed_bgcolor'] ) )
            $new_input['myfixed_bgcolor'] = sanitize_text_field( $input['myfixed_bgcolor'] );
			
		if( isset( $input['myfixed_opacity'] ) )
            $new_input['myfixed_opacity'] = absint( $input['myfixed_opacity'] );
			
		if( isset( $input['myfixed_transition_time'] ) )
            $new_input['myfixed_transition_time'] = sanitize_text_field( $input['myfixed_transition_time'] );
			
		if( isset( $input['myfixed_disable_small_screen'] ) )
            $new_input['myfixed_disable_small_screen'] = absint( $input['myfixed_disable_small_screen'] );
			
		if( isset( $input['mysticky_active_on_height'] ) )
            $new_input['mysticky_active_on_height'] = absint( $input['mysticky_active_on_height'] );
			
		if( isset( $input['myfixed_fade'] ) )
            $new_input['myfixed_fade'] = sanitize_text_field( $input['myfixed_fade'] ); 
		
		if( isset( $input['myfixed_cssstyle'] ) )
            //$new_input['myfixed_cssstyle'] = esc_textarea( $input['myfixed_cssstyle'] );
             $new_input['myfixed_cssstyle'] = sanitize_text_field( $input['myfixed_cssstyle'] );
			 
			 
        return $new_input;
    }
	
	 /**
     * Load Defaults
     */ 	
	public function mysticky_default_options() {
		
		global $options;
		
		
		$default = array(

				'mysticky_class_selector' => '.navbar',
				'myfixed_zindex' => '1000000',
				'myfixed_bgcolor' => '#F39A30',
				'myfixed_opacity' => '95',
				'myfixed_transition_time' => '0.3',
				'myfixed_disable_small_screen' => '359',
				'mysticky_active_on_height' => '320',
				'myfixed_fade' => false,
				'myfixed_cssstyle' => '.myfixed { margin:0 auto!important; float:none!important; border:0px!important; background:none!important; max-width:100%!important; }'	
				
			);

		if ( get_option('mysticky_option_name') == false ) {	
		
		
				
			update_option( 'mysticky_option_name', $default );		
		}

		/*
  foreach ( $options as $option => $default_value ) {
    if ( ! get_option( $option ) ) {
        add_option( $option, $default_value );
    } else {
        update_option( $option, $default_value );
    }
  }		
		*/	
}
	
    /** 
     * Print the Section text
     */
	 
    public function print_section_info()
    {
        print 'Add nice modern sticky menu or header to any theme. Defaults works for Twenty Thirteen theme. <br />For other themes change "Sticky Class" to div class desired to be sticky (div id can be used too).';
    }
    /** 
     * Get the settings option array and print one of its values
     */
	 
    public function mysticky_class_selector_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="mysticky_class_selector" name="mysticky_option_name[mysticky_class_selector]" value="%s" /> menu or header div class or id.</p>',
            isset( $this->options['mysticky_class_selector'] ) ? esc_attr( $this->options['mysticky_class_selector']) : '' 
        );
    }
	
    public function myfixed_zindex_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_zindex" name="mysticky_option_name[myfixed_zindex]" value="%s" /> sticky z-index.</p>',
            isset( $this->options['myfixed_zindex'] ) ? esc_attr( $this->options['myfixed_zindex']) : ''
        );
    }
	
	public function myfixed_bgcolor_callback()
    {
        printf(
            '<p class="description"><input type="text" size="8" id="myfixed_bgcolor" name="mysticky_option_name[myfixed_bgcolor]" value="%s" /> full width background color.</p>' ,
            isset( $this->options['myfixed_bgcolor'] ) ? esc_attr( $this->options['myfixed_bgcolor']) : ''
        );
    }
	
	public function myfixed_opacity_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_opacity" name="mysticky_option_name[myfixed_opacity]" value="%s" /> numbers 1-100.</p>',
            isset( $this->options['myfixed_opacity'] ) ? esc_attr( $this->options['myfixed_opacity']) : ''
        );
    }
	
	public function myfixed_transition_time_callback()
    {
        printf(
            '<p class="description"><input type="text" size="4" id="myfixed_transition_time" name="mysticky_option_name[myfixed_transition_time]" value="%s" /> in seconds.</p>',
            isset( $this->options['myfixed_transition_time'] ) ? esc_attr( $this->options['myfixed_transition_time']) : ''
        );
    }
	
	public function myfixed_disable_small_screen_callback()
	{
		printf(
		'<p class="description">less than <input type="text" size="4" id="myfixed_disable_small_screen" name="mysticky_option_name[myfixed_disable_small_screen]" value="%s" />px width, 0  to disable.</p>',
            isset( $this->options['myfixed_disable_small_screen'] ) ? esc_attr( $this->options['myfixed_disable_small_screen']) : ''
		);
	}
	
	public function mysticky_active_on_height_callback()
	{
		printf(
		'<p class="description">after <input type="text" size="4" id="mysticky_active_on_height" name="mysticky_option_name[mysticky_active_on_height]" value="%s" />px, </p>',
            isset( $this->options['mysticky_active_on_height'] ) ? esc_attr( $this->options['mysticky_active_on_height']) : ''
		);
	}
	
	public function myfixed_fade_callback()
	{
		printf(
			'<p class="description"><input id="%1$s" name="mysticky_option_name[myfixed_fade]" type="checkbox" %2$s /> Checked is slide, unchecked is fade.</p>',
			'myfixed_fade',
			checked( isset( $this->options['myfixed_fade'] ), true, false ) 
		);
		
	} 
	
   public function myfixed_cssstyle_callback()
   
    {
        printf(
            '
			<p class="description">Add/Edit .myfixed css class to change sticky menu style. Leave it blank for default style.</p>  <textarea type="text" rows="4" cols="60" id="myfixed_cssstyle" name="mysticky_option_name[myfixed_cssstyle]">%s</textarea> <br />
		' ,
            isset( $this->options['myfixed_cssstyle'] ) ? esc_attr( $this->options['myfixed_cssstyle']) : ''
        );
		echo '<p class="description">Default style: .myfixed { margin:0 auto!important; float:none!important; border:0px!important; background:none!important; max-width:100%!important; }<br /><br />If you want to change sticky hover color first add default style and than: .myfixed li a:hover {color:#000; background-color: #ccc;} .<br /> More examples <a href="http://wordpress.transformnews.com/tutorials/mystickymenu-extended-style-functionality-using-myfixed-sticky-class-403" target="blank">here</a>.</p>';
    }
	
}

	if( is_admin() )
    $my_settings_page = new MyStickyMenuPage();

	// end plugin admin settings

	// Remove default option for more link that jumps at the midle of page and its covered by menu

	function mysticky_remove_more_jump_link($link) 
	{ 
	
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

	// Create style from options

	function mysticky_build_stylesheet_content() {
	
	$mysticky_options = get_option( 'mysticky_option_name' );
	
    echo
'<style type="text/css">';
	if ( is_user_logged_in() ) {
    echo '#wpadminbar { position: absolute !important; top: 0px !important;}';
	}
	if (  $mysticky_options['myfixed_cssstyle'] == "" )  {
	echo '.myfixed { margin:0 auto!important; float:none!important; border:0px!important; background:none!important; max-width:100%!important; }';
	}
	echo
	  $mysticky_options ['myfixed_cssstyle'] ;
	
	echo
	'
	#mysticky-nav { width:100%!important;  position: static;';
	    
	if (isset($mysticky_options['myfixed_fade'])){
	
	echo
	'top: -100px;';
	}
	echo
	'}';
	
	if  ($mysticky_options ['myfixed_opacity'] == 100 ){
   
	
	echo
	'.wrapfixed { position: fixed!important; top:0px!important; left: 0px!important; margin-top:0px!important;  z-index: '. $mysticky_options ['myfixed_zindex'] .'; -webkit-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -moz-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -o-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;  background-color: ' . $mysticky_options ['myfixed_bgcolor'] . '!important;  }
	';
	}
	if  ($mysticky_options ['myfixed_opacity'] < 100 ){
   
	
	echo
	'.wrapfixed { position: fixed!important; top:0px!important; left: 0px!important; margin-top:0px!important;  z-index: '. $mysticky_options ['myfixed_zindex'] .'; -webkit-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -moz-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; -o-transition: ' . $mysticky_options ['myfixed_transition_time'] . 's; transition: ' . $mysticky_options ['myfixed_transition_time'] . 's;   -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=' . $mysticky_options ['myfixed_opacity'] . ')"; filter: alpha(opacity=' . $mysticky_options ['myfixed_opacity'] . '); opacity:.' . $mysticky_options ['myfixed_opacity'] . '; background-color: ' . $mysticky_options ['myfixed_bgcolor'] . '!important;  }
	';
	}
	
	if  ($mysticky_options ['myfixed_disable_small_screen'] > 0 ){
    echo
		'@media (max-width: ' . $mysticky_options ['myfixed_disable_small_screen'] . 'px) {.wrapfixed {position: static!important; display: none!important;}}
	';
	}
	echo 
'</style>
	';
	}
	
	add_action('wp_head', 'mysticky_build_stylesheet_content');
	
	
	function mystickymenu_script() {
		
		$mysticky_options = get_option( 'mysticky_option_name' );
		
		// Register scripts
			wp_register_script('mystickymenu', WP_PLUGIN_URL. '/mystickymenu/mystickymenu.js', false,'1.0.0', true);
			wp_enqueue_script( 'mystickymenu' );

		// Localize mystickymenu.js script with myStickymenu options
		$mysticky_translation_array = array( 
		    'mysticky_string' => $mysticky_options['mysticky_class_selector'] ,
			'mysticky_active_on_height_string' => $mysticky_options['mysticky_active_on_height'],
			'mysticky_disable_at_width_string' => $mysticky_options['myfixed_disable_small_screen']
		);
		
			wp_localize_script( 'mystickymenu', 'mysticky_name', $mysticky_translation_array );
	}

	add_action( 'wp_enqueue_scripts', 'mystickymenu_script' );
?>