<?php

/**
 *  XXL admin panel settings .   
 * @since       Version 1.0
 */



if (!class_exists('autorent_admin_config')) {

    class autorent_admin_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {


            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }



        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'autorent'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'autorent'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../options/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../options/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'autorent'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'autorent'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'autorent'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'autorent') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'autorent'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }




    /*
    |--------------------------------------------------------------------------
    | Start Home settings 
    |--------------------------------------------------------------------------
    | favicon , iphone favicon , ipad favicon , custom css , tracking code .         
    | 
    |
    */




            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(

                'title'     => __('Home Settings', 'autorent'),          
                'icon'      => 'el-icon-home',

                'fields'    => array(

                    array(
                        'id'        => 'autorent-favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon', 'autorent'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon.', 'autorent'),
                    ),


                    array(
                        'id'        => 'autorent-favicon-iphone',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon For iphone', 'autorent'),
                        'compiler'  => 'true',
                        'desc'      => __('Upload custom favicon for iphone.', 'autorent'),

                    ),


                    array(
                        'id'        => 'autorent-favicon-ipad',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon For ipad', 'autorent'),
                        'compiler'  => 'true',                       
                        'desc'      => __('Upload custom favicon for ipad', 'autorent'),
 
                    ),  

                    array(
                        'id'        => 'autorent-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS ', 'autorent'),
                        'subtitle'  => __('Paste your custom CSS code here.', 'autorent'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),


                    array(
                        'id'        => 'autorent-custom-js',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom JS', 'autorent'),
                        'subtitle'  => __('Paste your JS code here.', 'autorent'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                    ),
		

                ),
            );

    /*
    |--------------------------------------------------------------------------
    | End Home settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



    /*
    |--------------------------------------------------------------------------
    | start header settings 
    |--------------------------------------------------------------------------
    |
    | 
    |
    */

            $this->sections[] = array(
                'icon'      => 'el-icon-paper-clip',
                'title'     => __('Header Settings', 'autorent'),
                'fields'    => array(


                    array(
                        'id'        => 'autorent-header-icon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header icon', 'autorent'),
                        'compiler'  => 'true',                        
                        'subtitle'      => __('Upload header icon.', 'autorent'),
                 
                    ),

                    array(
                        'id'        => 'autorent_header_car_icon',
                        'type'      => 'switch',                      
                        'title'     => __(' Header Car Icon', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'autorent_login_button',
                        'type'      => 'switch',                      
                        'title'     => __('Login button', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent-share-button',
                        'type'      => 'switch',                      
                        'title'     => __('Share button', 'autorent'),                       
                        'default'   => true,
                    ),                    

                    array(
                        'id'        => 'autorent-share-button-facebook',
                        'type'      => 'switch',                      
                        'title'     => __(' Facebook Share button', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent-share-button-twitter',
                        'type'      => 'switch',                      
                        'title'     => __(' Twitter Share button', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent-share-button-linkedin',
                        'type'      => 'switch',                      
                        'title'     => __(' LinkedIn Share button', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'autorent-top-language',
                        'type'      => 'switch',                   
                        'title'     => __('Show Language ', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent-language',
                        'type'      => 'multi_text',
                        'title'     => __('Language', 'autorent'),
                        'required'  => array('autorent-top-language', '=', '1'),                      
                        'default'   => array(
                            'en' => 'EN',
                            'de' => 'DE',
                            'it' => 'IT',
                            'fr' => 'FR',
                        )
                    ),


                    array(
                        'id'        => 'autorent-login-option',
                        'type'      => 'switch',                      
                        'title'     => __('Login option', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'       => 'autorent-wpml-select',
                        'type'     => 'select',
                        'title'    => __('WPML language show type', 'autorent'),
                        'subtitle' => __('Select the type how you want to show language selector', 'autorent'),
                        'desc'     => __('This select type will only work if WPML activated in your theme', 'autorent'),
                       
                        'options'  => array(
                            'code' => 'Language Code',
                            'name' => 'Language Name',
                            'flag' => 'Flag'
                        ),
                        'default'  => 'name',
                    ),


                    array(
                        'id'        => 'autorent_header_bg_color',
                        'type'      => 'color_rgba',
                        'title'     => __('Header color', 'autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!', 'autorent'),                    
                        'default'   => array(
                            'color'     => '#333333',
                            'alpha'     => 1
                        ),                     
                                     
                    ),


                    array(
                        'id'        => 'autorent_header_bg_image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('header background image', 'autorent'),      
                        'compiler'  => 'true',                        
                        'subtitle'      => __('Upload background image for header menu', 'autorent'),                 
                    ),



                )
            );




    /*
    |--------------------------------------------------------------------------
    | End Header settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */





    /*
    |--------------------------------------------------------------------------
    | Start banner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-bookmark',
                'title' => __('Banner Options', 'autorent'),
                
                'fields' => array(
                    
                    array(
                        'id'        => 'autorent-home-page-banner',
                        'type'      => 'switch',                   
                        'title'     => __('Home Page Banner Section', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'autorent-home-page-banner-image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Home Page Banner Image', 'autorent'),
                        'compiler'  => 'true',
                        'desc'      => __('change your home page banner image', 'autorent'),
                    ),


                    array(
                        'id'        => 'autorent-home-page-search',
                        'type'      => 'switch',                   
                        'title'     => __('Search From Home Page', 'autorent'),                       
                        'default'   => true,
                    ),                    

                    array(
                        'id'        => 'autorent-general-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image (General)', 'autorent'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for general blogging templates', 'autorent'),
                      
                    ), 


                    array(
                        'id'        => 'autorent-general-banner-color',
                        'type'      => 'color_rgba',
                        'title'     => __('Header Banner Color (General)','autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!', 'autorent'),                    
                        'default'   => array(
                            'color'     => '#1a1a1a',
                            'alpha'     => 1
                        ),                     
                                     
                    ),

                    array(
                        'id'        => 'autorent-product-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Fleets)', 'autorent'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for product templates', 'autorent'),
                      
                    ), 

                    array(
                        'id'        => 'autorent-product-banner-color',
                        'type'      => 'color_rgba',
                        'title'     => __('Header Banner Color (Fleets)','autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!','autorent'),                     
                        'default'   => array(
                            'color'     => '#1a1a1a',
                            'alpha'     => 1
                        ),                     
                                     
                    ),

                    array(
                        'id'        => 'autorent-frontpage-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Any page with autorent build page temlates)', 'autorent'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for Service or about or any page with autorent build page temlates', 'autorent'),
                    ),


                    array(
                        'id'        => 'autorent-frontpage-banner-color',
                        'type'      => 'color_rgba',
                        'title'     => __('Header Banner Color (Any page with autorent build page temlates)','autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!','autorent'),                     
                        'default'   => array(
                            'color'     => '#1a1a1a',
                            'alpha'     => 1
                        ),                     
                                     
                    ),

                    
                    array(
                        'id'        => 'autorent-contact-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Contact)', 'autorent'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for contact templates', 'autorent'),
                    ),

                    array(
                        'id'        => 'autorent-contact-banner-color',
                        'type'      => 'color_rgba',
                        'title'     => __('Header Banner Color (contact)','autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!','autorent'),                     
                        'default'   => array(
                            'color'     => '#1a1a1a',
                            'alpha'     => 1
                        ),                     
                                     
                    ),


                    array(
                        'id'        => 'autorent-defaultpage-banner',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Banner Image(Default Page Templates)', 'autorent'),
                        'compiler'  => 'true',                       
                        'subtitle'      => __('Upload page header image for Default Page Templates', 'autorent'),
                    ),

                    array(
                        'id'        => 'autorent-defaultpage-banner-color',
                        'type'      => 'color_rgba',
                        'title'     => __('Header Banner Color (defaultpage)','autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!','autorent'),                     
                        'default'   => array(
                            'color'     => '#1a1a1a',
                            'alpha'     => 1
                        ),                     
                                     
                    ),
                    
                )
            );

 /*
    |--------------------------------------------------------------------------
    | End banner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start rental experience content block
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-car',
                'title' => __('Rental Experience Block', 'autorent'),
                
                'fields' => array(
                    
                    array(
                        'id'        => 'autorent-rental-experience-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Car Rental Experience Block', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent-rental-experience-bg',
                        'type'      => 'media', 
                        'url'       => true,                  
                        'title'     => __('Car Rental Block Background Image', 'autorent'),                       
                    ),

                    array(
                        'id'        => 'autorent-rental-experience-part1text',
                        'type'      => 'text',                    
                        'title'     => __('Rental Experience Text Part 1', 'autorent'),
                     
                    ),

                    array(
                        'id'        => 'autorent-rental-experience-part2text',
                        'type'      => 'text',                    
                        'title'     => __('Rental Experience Text Part 2', 'autorent'),
                     
                    ),


                    array(
                        'id'        => 'autorent-rental-experience-readmore-button-text',
                        'type'      => 'text',                    
                        'title'     => __('Read More Button Text', 'autorent'),
                     
                    ),

                    array(
                        'id'        => 'autorent-rental-experience-readmore-button-url',
                        'type'      => 'text',                    
                        'title'     => __('Read More Button URL', 'autorent'),
                     
                    ),


                    array(
                        'id'        => 'autorent-rental-experience-purchase-button-text',
                        'type'      => 'text',                    
                        'title'     => __('Purchase Now Button Text', 'autorent'),
                     
                    ),

                    array(
                        'id'        => 'autorent-rental-experience-purchase-button-url',
                        'type'      => 'text',                    
                        'title'     => __('Purchase Now Button URL', 'autorent'),
                     
                    ),

                    array(
                        'id'        => 'autorent-rental-experience-bg-color',
                        'type'      => 'color_rgba',
                        'title'     => __('Rental Experience background color','autorent'),
                        'default'   => array(
                            'color'     => '#fec601',
                            'alpha'     => 1
                        ),                     
                                     
                    ),



                )
            );

    /*
    |--------------------------------------------------------------------------
    | End our rental experiecne content block
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start autorent service features block
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-heart',
                'title' => __('Service Features', 'autorent'),
                
                'fields' => array(
                    
                    array(
                        'id'        => 'autorent-service-feature-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show AutoRent Service Features Block', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'          => 'autorent-service-features-slides',
                        'type'        => 'slides',
                        'title'       => __('Include Your Feature Services', 'autorent'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        'placeholder' => array(
                            'title'           => __('This is a title', 'autorent'),
                            'description'     => __('Description Here', 'autorent'),
                            'url'             => __('Font-Awesome Icon Name', 'autorent'),
                          
                        ),
                    ),
                                        
                )
            );

    /*
    |--------------------------------------------------------------------------
    | End autorent service features block
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start our partner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-group',
                'title' => __('Our Partners Options', 'autorent'),
                
                'fields' => array(
                    
                    array(
                        'id'        => 'autorent-partners-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Our Partners', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'          => 'autorent-our-partners',
                        'type'        => 'slides',
                        'title'       => __('Our Parners', 'autorent'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        'placeholder' => array(
                            'title'           => __('This is a title', 'autorent'),
                            'description'     => __('Description Here', 'autorent'),
                            'url'             => __('Give us a link!', 'autorent'),
                        ),
                    ),


                    array(
                        'id'        => 'autorent_our_partner_bg_color',
                        'type'      => 'color_rgba',
                        'title'     => __('Our Partner Banner Color','autorent'),
                        'subtitle'  => __('Set color channel','autorent'),
                        'desc'      => __('The caption of this button may be changed to whatever you like!','autorent'),                     
                        'default'   => array(
                            'color'     => '#f3f3f3',
                            'alpha'     => 1
                        ),                     
                                     
                    ),


                    array(
                        'id'        => 'autorent_our_partner_bg_image',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Our partenr background image', 'autorent'),      
                        'compiler'  => 'true',                        
                        'subtitle'      => __('Upload background image for partner section', 'autorent'),                 
                    ), 



                )
            );

    /*
    |--------------------------------------------------------------------------
    | End our partner settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



     /*
    |--------------------------------------------------------------------------
    | Start our brands settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


            $this->sections[] = array(

                'icon' => 'el-icon-glass',
                'title' => __('Get Started Block', 'autorent'),
                
                'fields' => array(


                    array(
                        'id'        => 'autorent_get_started_name_change',
                        'type'      => 'text',                    
                        'title'     => __('Change Get Started Title', 'autorent'),

                    ),

                    
                    array(
                        'id'        => 'autorent-car-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Our Cars Tab', 'autorent'),                       
                        'default'   => true,
                    ),


                    array(
                        'id'        => 'autorent_our_car_name_change',
                        'type'      => 'text',                    
                        'title'     => __('Our car change title', 'autorent'),

                    ),


                    array(
                        'id'       => 'autorent-tab-select',
                        'type'     => 'select',
                        'title'    => __('Choose Taxonomy For Our Cars Tab', 'autorent'),
                        'subtitle' => __('Select a type thats terms will how in our car tab', 'autorent'),
                                               
                        'options'  => array(
                            'product_cat' => 'Car Categories',
                            'product_tag' => 'Car Tags',
                            'car_type' => 'Car Types',
                            'car_brand' => 'Car Brands',
                            'car_model' => 'Car Models',                           
                        ),

                        'default'  => 'car_type',
                    ), 


                     array(
                        'id'        => 'autorent-brands-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Our Brands', 'autorent'),                       
                        'default'   => true,
                    ),

                   
                    array(
                        'id'        => 'autorent_brand_name_change',
                        'type'      => 'text',                    
                        'title'     => __('Our Brands Name Change', 'autorent'),
                       
                    ), 

                    array(
                        'id'        => 'autorent-location-switch',
                        'type'      => 'switch',                   
                        'title'     => __('Our Location Tab', 'autorent'),                       
                        'default'   => true,
                    ),

                     array(
                        'id'        => 'autorent_location_name_change',
                        'type'      => 'text',                    
                        'title'     => __('Our Location Change Name', 'autorent'),                      
                    ),                    

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End our brands settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start our brands settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
            $this->sections[] = array(

                'icon' => 'el-icon-leaf',
                'title' => __('Our Brands', 'autorent'),
                
                'fields' => array(                    
                    


                    array(
                        'id'          => 'autorent-our-brands',
                        'type'        => 'slides',
                        'title'       => __('Our Brands', 'autorent'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'redux-framework-demo'),
                        'placeholder' => array(
                            'title'           => __('This is a title', 'autorent'),
                            'description'     => __('Description Here', 'autorent'),
                            'url'             => __('Give us a link!', 'autorent'),
                        ),
                    ),

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End our brands settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */   
    



    /*
    |--------------------------------------------------------------------------
    | Start search page Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */    
            $get_all_pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'atmf-search.php'
            ));         

            $all_pages = array();

            if(isset($get_all_pages) && !empty($get_all_pages)){
                foreach ($get_all_pages as $key => $value) {
                  $all_pages[$value->ID] = $value->post_title;    
                }
            }

            $this->sections[] = array(
                'icon'      => 'el-icon-search-alt',
                'title'     => __('Search Page Options', 'autorent'),
                'fields'    => array(

                    array(
                        'id'        => 'autorent-select-search-page',
                        'type'      => 'select',
                        'title'     => __('Search Page', 'autorent'),
                        'subtitle'  => __('When you select your search page the advance property search form will be appear in top header and home page. and the search result will show in this page', 'autorent'),
                        'options'   => $all_pages,                        
                    ), 

                    array(
                        'id'       => 'autorent_select_template_view',
                        'type'     => 'select',
                        'title'    => __('Choose Listing page view', 'autorent'),
                        'subtitle' => __('Select a type thats terms will how in our car listing page', 'autorent'),                                               
                        'options'  => array(
                            'list' => 'List View',
                            'grid' => 'Grid View',                                               
                        ),
                        'default'  => 'list',
                    ),

                    array(                        
                        'id'        => 'autorent_quick_search_placeholder',
                        'type'      => 'text',                    
                        'title'     => __('Quick search placeholder in car listing page', 'autorent'),
                        'default'   => 'Quick Search',
                    ), 

                    array(
                        
                        'id'        => 'autorent_listing_hireon_data',
                        'type'      => 'text',                    
                        'title'     => __('Hire on placeholder in car listing page', 'autorent'),
                        'default'   => 'Hire on',
                    ), 

                    array(
                        
                        'id'        => 'autorent_listing_returnon_data',
                        'type'      => 'text',                    
                        'title'     => __('Return on placeholder in car listing page', 'autorent'),
                        'default'   => 'Return on',
                    ), 

                     array(
                        'id'        => 'autorent_car_storting_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Sorting Dropdown', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'       => 'autorent_multiple_sorting_options',
                        'type'     => 'select',
                        'multi'    => true,
                        'title'    => __('Select Your Sorting Options', 'autorent'),                         
                        'options'  => array(
                                'post_title' => 'Title',
                                'post_date' => 'Date',
                                'post_id' => 'ID', 
                                'price' => 'Price',
                                'additional_people' => 'Additional People',
                                'fuel_capacity' => 'Fuel Capacity',
                                'max_speed' => 'Speed',
                                'max_weight' => 'Weight',
                                'min_pilots' => 'Drivers',                                                               
                                'vehicle_age' => 'Vechicle Age',                                
                            ),
                        'default'  => array('post_title')
                    ),

                    array(
                        'id'       => 'autorent_default_sorting_options',
                        'type'     => 'select',
                        'title'    => __('Select Default Sorting Option', 'autorent'), 
                        'options'  => array(
                                'post_title' => 'Title',
                                'post_date' => 'Date',
                                'post_id' => 'ID', 
                                'price' => 'Price',
                                'additional_people' => 'Additional People',
                                'fuel_capacity' => 'Fuel Capacity',
                                'max_speed' => 'Speed',
                                'max_weight' => 'Weight',
                                'min_pilots' => 'Drivers',                                                               
                                'vehicle_age' => 'Vechicle Age',                                
                            ),
                        'default'  => array('post_title')
                    )

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



    /*
    |--------------------------------------------------------------------------
    | Start search page Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */    
            
            $this->sections[] = array(
                'icon'      => 'el-icon-envelope',
                'title'     => __('Search Form Options (Homepage)', 'autorent'),
                'fields'    => array(                    

                    array(
                        'id'        => 'autorent_booktype_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Book Tab', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent_buytype_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Buy Tab', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'autorent_search_location_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Location', 'autorent'),                       
                        'default'   => true,
                    ),

                   
                    array(
                        
                        'id'        => 'autorent_location_chage_name',
                        'type'      => 'text',                    
                        'title'     => __('Change Location Title', 'autorent'),
                       
                    ), 

                    array(
                        
                        'id'        => 'autorent_location_index',
                        'type'      => 'text',                    
                        'title'     => __('Location Index No. ', 'autorent'),
                        'default'   => '1',
                    ), 


                    array(
                        'id'       => 'autoren_search_location_select',
                        'type'     => 'select',
                        'title'    => __('Choose Taxonomy For Car Location', 'autorent'),
                        'subtitle' => __('Select a type thats terms will how in our car tab', 'autorent'),
                                               
                        'options'  => array(
                            'state' => 'State',
                            'city' => 'City',
                            'airport' => 'Airport',                           
                        ),

                        'default'  => 'city',
                    ),


                    array(
                        'id'        => 'autorent_return_location_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Return Location', 'autorent'),                       
                        'default'   => true,
                    ),

                   
                    array(
                        
                        'id'        => 'autorent_return_location_chage_name',
                        'type'      => 'text',                    
                        'title'     => __('Change Return Location Title', 'autorent'),
                       
                    ), 


                    array(
                        'id'       => 'autoren_return_location_select',
                        'type'     => 'select',
                        'title'    => __('Choose Taxonomy For Car Return Location', 'autorent'),
                        'subtitle' => __('Select a type thats terms will how in our car tab', 'autorent'),
                                               
                        'options'  => array(
                            'return_location' => 'Return Location',                                                       
                        ),

                        'default'  => 'return_location',
                    ),                    


                    array(
                        'id'        => 'autorent_pickup_date_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Pickup Date', 'autorent'),                       
                        'default'   => true,
                    ),

                    array(
                        
                        'id'        => 'autorent_date_index',
                        'type'      => 'text',                    
                        'title'     => __('Date Index No. ', 'autorent'),
                        'default'   => '2',
                    ), 

                   
                    array(
                        'id'        => 'autorent_pickup_date_chage_name',
                        'type'      => 'text',                    
                        'title'     => __('Change Pickup Date Title', 'autorent'),
                       
                    ), 

                    array(
                        'id'        => 'autorent_return_date_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Return Date', 'autorent'),                       
                        'default'   => true,
                    ),

                   
                    array(
                        'id'        => 'autorent_return_date_chage_name',
                        'type'      => 'text',                    
                        'title'     => __('Change Return Date Title', 'autorent'),
                       
                    ), 



                    array(
                        'id'        => 'autorent_car_type_search_switch',
                        'type'      => 'switch',                   
                        'title'     => __('Show Car Type On Search', 'autorent'),                       
                        'default'   => true,
                    ),

                   
                    array(
                        'id'        => 'autorent_car_type_search_chage_name',
                        'type'      => 'text',                    
                        'title'     => __('Change Car Type Title', 'autorent'),
                       
                    ),  

                    array(
                        
                        'id'        => 'autorent_car_type_index',
                        'type'      => 'text',                    
                        'title'     => __('Book Car Type Index No. ', 'autorent'),
                        'default'   => '3',
                    ), 

                    array(
                        
                        'id'        => 'autorent_buy_car_type_index',
                        'type'      => 'text',                    
                        'title'     => __('Buy Car Type Index No. ', 'autorent'),
                        'default'   => '2',
                    ), 


                    array(
                        'id'       => 'autorent_car_type_search_select',
                        'type'     => 'select',
                        'title'    => __('Choose Taxonomy For Car Type Search Box', 'autorent'),
                        'subtitle' => __('Select a type thats terms will how in our car tab', 'autorent'),
                                               
                        'options'  => array(
                            'product_cat' => 'Car Categories',
                            'product_tag' => 'Car Tags',
                            'car_type' => 'Car Types',
                            'car_brand' => 'Car Brands',
                            'car_model' => 'Car Models',                           
                        ),

                        'default'  => 'car_type',
                    ),                     

                )
            );

    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */












    /*
    |--------------------------------------------------------------------------
    | Start Single Listing page
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
  

        $this->sections[] = array(

            'icon'      => 'el-icon-th-large',
            'title'     => __('Listing Single Page Options', 'autorent'),
            'fields'    => array(

                array(
                    'id'        => 'autorent_google_map_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Google Map', 'autorent'),                       
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent_show_property_details_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Property Details', 'autorent'),                       
                    'default'   => true,
                ),


                array(
                    'id'        => 'autorent_show_booking_form_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Booking Form', 'autorent'),                       
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent_show_resource_field_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Resource Field', 'autorent'),                       
                    'default'   => true,
                ),


                array(
                    'id'        => 'autorent_show_person_field_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Person Field', 'autorent'),                       
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent_show_tab_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Tabs', 'autorent'),                       
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent_show_related_product_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Related Cars', 'autorent'),                       
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent_no_of_related_product',
                    'type'      => 'text',                   
                    'title'     => __('No. of related prdouct', 'autorent'),                       
                    'default'   => '3',
                ),


            )
        );



    /*
    |--------------------------------------------------------------------------
    | End Single Listing page
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



    /*
    |--------------------------------------------------------------------------
    | Start Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
  

        $this->sections[] = array(

            'icon'      => 'el-icon-search',
            'title'     => __('Quick Search Home page Banner', 'autorent'),
            'fields'    => array(

                array(
                    'id'        => 'autorent_quick_search_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Quick Search Section', 'autorent'),                       
                    'default'   => true,
                ),

                array(
                    'id'       => 'autorent_quick_search_select_tax',
                    'type'     => 'select',
                    'title'    => __('Choose Taxonomy For Quick Search', 'autorent'),
                    'subtitle' => __('Select a taxonomy thats terms will how in our car tab', 'autorent'),
                                           
                    'options'  => array(
                        'reservation_type' => 'Reservation Type',
                        'product_cat' => 'Car Categories',
                        'product_tag' => 'Car Tags',
                        'car_type' => 'Car Types',
                        'car_brand' => 'Car Brands',
                        'car_model' => 'Car Models',                           
                    ),

                    'default'  => 'reservation_type',
                ), 


                array(
                    'id'        => 'autorent_intro_switch',
                    'type'      => 'switch',                   
                    'title'     => __('Show Intro Section', 'autorent'),                       
                    'default'   => true,
                ),


                array(
                    'id'        => 'autorent_intro_title_text',
                    'type'      => 'text',                   
                    'title'     => __('Inro Title Text', 'autorent'),                       
                    
                ),


                array(
                    'id'        => 'autorent_intro_subtitle_text',
                    'type'      => 'text',                   
                    'title'     => __('Inro Sub Title Text', 'autorent'),                       
                   
                ),


            )
        );



    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */








    /*
    |--------------------------------------------------------------------------
    | Start Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
  

        $this->sections[] = array(

            'icon'      => 'el-icon-map-marker',
            'title'     => __('Map Options', 'autorent'),
            'fields'    => array(

                array(
                    'id'        => 'autorent_map_zoom_car_single_map',
                    'type'      => 'text',                      
                    'title'     => __('Control map zoom label in Car details page', 'autorent'),
                    'subtitle'  => __('enter numerica value here as example 14', 'autorent'),                        
                    'default'   => '14',
                ),


                array(
                    'id'        => 'autorent_map_zoom_for_contact_page',
                    'type'      => 'text',                      
                    'title'     => __('Control map zoom label contact page', 'autorent'),
                    'subtitle'  => __('enter numerica value here as example 14', 'autorent'),                        
                    'default'   => '10',
                ),

                array(
                    'id'        => 'autorent_map_zoom_for_essential_block',
                    'type'      => 'text',                      
                    'title'     => __('Control map zoom label Essentials section', 'autorent'),
                    'subtitle'  => __('enter numerica value here as example 14', 'autorent'),                        
                    'default'   => '12',
                ),

            )
        );



    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */





    /*
    |--------------------------------------------------------------------------
    | Start Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */
  

        $this->sections[] = array(
            'icon'      => 'el-icon-photo',
            'title'     => __('Footer Options', 'autorent'),
            'fields'    => array(

                array(
                    'id'        => 'autorent-show-footer-widgets',
                    'type'      => 'switch',                      
                    'title'     => __('Show Footer Widgets', 'autorent'),
                    'subtitle'  => __('Decide show Footer Widgets or Not', 'autorent'),                        
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent-footer-widgets-icon',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => __('Footer Widgets Icon', 'autorent'),      
                    'compiler'  => 'true',                        
                    'subtitle'      => __('Upload footer widgets icon', 'autorent'),
             
                ), 

                array(
                    'id'        => 'autorent-show-footer-copyrights',
                    'type'      => 'switch',                      
                    'title'     => __('Show Footer Copyrights', 'autorent'),
                    'subtitle'  => __('Decide show Footer copyrights or Not', 'autorent'),                        
                    'default'   => true,
                ),

                array(
                    'id'        => 'autorent-copyright-text',
                    'type'      => 'text',
                    'title'     => __('Copyright Text', 'autorent'),
                    'subtitle'  => __('Enter your copyright text', 'autorent'),
                    'placeholder' => __('Copyright 2013 &copy; autorent. All rights reserved','autorent')                        
                ),

                array(
                    'id'        => 'autorent-powered-by',
                    'type'      => 'text',
                    'title'     => __('Powered By', 'autorent'),
                    'subtitle'  => __('Enter your company name', 'autorent'),
                    'placeholder' => __('autorent','autorent')                        
                ),

                array(
                    'id'        => 'autorent-company-link',
                    'type'      => 'text',
                    'title'     => __('Company Link', 'autorent'),
                    'subtitle'  => __('Enter your company link', 'autorent'),
                    'placeholder' => __('https://www.example.com','autorent')                        
                ),


                array(
                    'id'        => 'autorent_footer_bg_color',
                    'type'      => 'color_rgba',
                    'title'     => 'Footer color',
                    'subtitle'  => 'Set color channel',
                    'desc'      => 'The caption of this button may be changed to whatever you like!',                     
                    'default'   => array(
                        'color'     => '#333333',
                        'alpha'     => 1
                    ),                     
                                 
                ),


                array(
                    'id'        => 'autorent_footer_bg_image',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => __('footer background image', 'autorent'),      
                    'compiler'  => 'true',                        
                    'subtitle'      => __('Upload background image for footer', 'autorent'),                 
                ),


                array(
                    'id'        => 'autorent_copyright_bg_color',
                    'type'      => 'color_rgba',
                    'title'     => 'Copyright section color',
                    'subtitle'  => 'Set color channel',
                    'desc'      => 'The caption of this button may be changed to whatever you like!',                     
                    'default'   => array(
                        'color'     => '#1a1a1a',
                        'alpha'     => 1
                    ),                     
                                 
                ),


                array(
                    'id'        => 'autorent_copyright_bg_image',
                    'type'      => 'media',
                    'url'       => true,
                    'title'     => __('footer copyright background image', 'autorent'),      
                    'compiler'  => 'true',                        
                    'subtitle'      => __('Upload background image for footer copyright', 'autorent'),                 
                ),


            )
        );



    /*
    |--------------------------------------------------------------------------
    | End Footer Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


    /*
    |--------------------------------------------------------------------------
    | Start Styling Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */


            $this->sections[] = array(
                'icon'      => 'el-icon-website',
                'title'     => __('Styling Options', 'autorent'),
                'fields'    => array(
                   
             
                    array(
                        'id'            => 'casa-body-typography',
                        'type'          => 'typography',
                        'title'         => __('Body', 'autorent'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'default'   => '',

                    ),

                    array(
                        'id'            => 'casa-header-typography',
                        'type'          => 'typography',
                        'title'         => __('Header', 'autorent'),
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('h1','h2','h3','h4','h5'), // An array of CSS selectors to apply this font style to dynamically

                        'units'         => 'px', // Defaults to px
                        'default'   => '',
                    ),

                )
            );


    /*
    |--------------------------------------------------------------------------
    | End Styling Options settings
    |--------------------------------------------------------------------------
    |
    | 
    |
    */



            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'autorent') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'autorent') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'autorent') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'autorent') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'autorent'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }
            

            $this->sections[] = array(
                'title'     => __('Import / Export', 'autorent'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'autorent'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    


            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'autorent'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'autorent'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'autorent')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'autorent'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'autorent')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'autorent');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'autorent_option_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => false,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('AutoRent', 'autorent'),
                'page_title'        => __('AutoRent', 'autorent'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBj4Lx93qjbVn9_p3Kqx178aDp4G6YrFeg', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'autorent_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                // 'hints' => array(
                //     'icon'          => 'icon-question-sign',
                //     'icon_position' => 'right',
                //     'icon_color'    => 'lightgray',
                //     'icon_size'     => 'normal',
                //     'tip_style'     => array(
                //         'color'         => 'light',
                //         'shadow'        => true,
                //         'rounded'       => false,
                //         'style'         => '',
                //     ),
                //     'tip_position'  => array(
                //         'my' => 'top left',
                //         'at' => 'bottom right',
                //     ),
                //     'tip_effect'    => array(
                //         'show'          => array(
                //             'effect'        => 'slide',
                //             'duration'      => '500',
                //             'event'         => 'mouseover',
                //         ),
                //         'hide'      => array(
                //             'effect'    => 'slide',
                //             'duration'  => '500',
                //             'event'     => 'click mouseleave',
                //         ),
                //     ),
                // )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/uouapps',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/UOUapps/281914991973646',
                'title' => 'Like us on Facebook',
                'icon'  => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/uouapps',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://linkedin.com/company/uou-apps',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
              //  $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'autorent'), $v);
            } else {
              //  $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'autorent');
            }

            // Add content after the form.
         //   $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'autorent');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new autorent_admin_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
