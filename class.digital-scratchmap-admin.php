<?php

class digital_scratchmap_admin
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
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Digital Scratchmap Settings', 
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'digital_scratchmap_settings' );
        ?>
        <div class="wrap">
            <h1>Digital Scratchmap Settings</h1>
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'digital_scratchmap_settings_group' );
                do_settings_sections( 'my-setting-admin' );
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
        register_setting(
            'digital_scratchmap_settings_group', // Option group
            'digital_scratchmap_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'My Custom Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        /*add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );*/      

        add_settings_field(
            'Google_Maps_API_key', 
            'Google Maps API Key', 
            array( $this, 'title_callback' ), 
            'my-setting-admin', 
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
        /*if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );*/

        if( isset( $input['Google_Maps_API_key'] ) )
            $new_input['Google_Maps_API_key'] = sanitize_text_field( $input['Google_Maps_API_key'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    /*public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="digital_scratchmap_settings[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }*/

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="Google_Maps_API_key" name="digital_scratchmap_settings[Google_Maps_API_key]" value="%s" />',
            isset( $this->options['Google_Maps_API_key'] ) ? esc_attr( $this->options['Google_Maps_API_key']) : ''
        );
    }
}

//if( is_admin() )
  //  $my_settings_page = new MySettingsPage();

?>