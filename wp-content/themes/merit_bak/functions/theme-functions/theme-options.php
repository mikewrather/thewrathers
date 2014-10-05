<?php
/**
 * Redux theme option settings
 *
 * @package ReduxFramework
 * @subpackage Merit
 * @since Merit 1.0.0
 */
if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

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

        public function setSections() {

            // ACTUAL DECLARATION OF SECTIONS
            // General Setings
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General', 'merit'),
                'fields' => array(              
                    array(
                        'id'                => 'rtl_support',
                        'type'              => 'button_set',
                        'title'             => __('RTL Support', 'qaween'), 
                        'desc'              => __('Enable right to left text support.', 'merit'),
                        'options'           => array('1' => 'Yes', '2' => 'No'),
                        'default'           => '2'
                    ),

                    array(
                        'id'                => 'tracking_code',
                        'type'              => 'textarea',
                        'title'             => __('Tracking Code', 'merit'),
                        'desc'              => __('Paste your Google Analytics or other tracking code here. Validate that it\'s javascript!', 'merit'),
                    ),
                )
            );

            // The Wedding Setings
            $this->sections[] = array(
                'icon' => ' el-icon-calendar',
                'title' => __('The Wedding', 'merit'),
                'fields' => array(
                    array(
                        'id'                => 'wedding_date',
                        'type'              => 'date',
                        'title'             => __('Wedding date', 'merit'),
                        'desc'              => __('Wedding date. Format: <code>MM/DD/YYYY.', 'merit'),
                        'placeholder'       => __('Click to enter a date', 'merit'),
                        'default'           => '02/14/2015',
                    ),

                    array(
                        'id'                => 'wedding_time',
                        'type'              => 'text',
                        'title'             => __('Wedding time', 'merit'),
                        'desc'              => __('Wedding time. Format: <code>HH:MM</code> (24 hour format).', 'merit'),
                        'placeholder'       => __('For example 14:00', 'merit'),
                        'default'           => '14:00',
                    ),
                )
            );

            
            // The Couple Setings
            $this->sections[] = array(
                'icon'          => 'el-icon-heart',
                'title'         => __('The Couple', 'merit'),
                'fields' => array(
                    // Groom
                    array(
                        'id'                => 'divider_couple_groom',
                        'desc'              => __('Groom Info', 'merit'),
                        'type'              => 'info'
                    ),

                    array(
                        'id'                => 'name_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Full Name', 'merit'),
                        'default'           => 'Groom Name',
                    ),

                    array(
                        'id'                => 'about_groom',
                        'type'              => 'textarea',
                        'title'             => __('Groom short description', 'merit'),
                        'default'           => 'Write down a short description about the groom. Lorem ipsum dolor sit amet, id eum tota feugait. Nam altera gloriatur ea, id etiam feugait assentior est.',
                    ),

                    array(
                        'id'                => 'photo_groom',
                        'type'              => 'media', 
                        'url'               => true,
                        'title'             => __('Groom Photo', 'merit'),
                        'desc'              => __('Please upload 150x150 image.', 'merit'),
                        'compiler'          => 'true',
                        'default'           => array('url' => 'http://placehold.it/200x200/f5f5f5/666666/&text=Groom'),
                    ),

                    array(
                        'id'                => 'url_facebook_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Facebook Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_twitter_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Twitter Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_gplus_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Google+ Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_pinterest_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Pinterest Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_youtube_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Youtube Profile URL', 'merit'), 
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_flickr_groom',
                        'type'              => 'text',
                        'title'             => __('Groom Flickr Profile URL', 'merit'), 
                        'default'           => '#',
                    ),

                    // Bride
                    array(
                        'id'                    => 'divider_couple_bride',
                        'type'                  => 'info',
                        'desc'                  => 'The Bride',
                    ),

                    array(
                        'id'                => 'name_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Full Name', 'merit'), 
                        'default'           => 'Bride Name',
                    ),

                    array(
                        'id'                => 'about_bride',
                        'type'              => 'textarea',
                        'title'             => __('Bride short description', 'merit'),
                        'default'           => 'Write down a short description about the bride. Lorem ipsum dolor sit amet, id eum tota feugait. Nam altera gloriatur ea, id etiam feugait assentior est.',
                    ),

                    array(
                        'id'                => 'photo_bride',
                        'type'              => 'media', 
                        'url'               => true,
                        'title'             => __('Bride Photo', 'merit'),
                        'desc'              => __('Please upload 150x150 image.', 'merit'),
                        'compiler'          => 'true',
                        'default'           => array('url' => 'http://placehold.it/200x200/f5f5f5/666666/&text=Bride'),
                    ),

                    array(
                        'id'                => 'url_facebook_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Facebook Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_twitter_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Twitter Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_gplus_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Google+ Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_pinterest_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Pinterest Profile URL', 'merit'),
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_youtube_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Youtube Profile URL', 'merit'), 
                        'default'           => '#',
                    ),

                    array(
                        'id'                => 'url_flickr_bride',
                        'type'              => 'text',
                        'title'             => __('Bride Flickr Profile URL', 'merit'), 
                        'default'           => '#',
                    ),
                )
            );

            // Appearance Settings
           $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => __('Appearance', 'merit'),
                'fields' => array(
                    array(
                        'id'                => 'logo_type',
                        'type'              => 'button_set',
                        'title'             => __('Logo Type', 'merit'), 
                        'desc'              => __('Select logo type.', 'merit'),
                        'options'           => array('1' => __('Text', 'merit'), '2' => __('Image', 'merit')),
                        'default'           => '1'
                    ),

                    array(
                        'id'                => 'logo_text',
                        'type'              => 'text',
                        'required'          => array('logo_type', 'equals', '1'),
                        'title'             => __('Text Logo', 'merit'), 
                        'desc'              => __('Bride & Groom names.', 'merit'),
                        'placeholder'       => '',
                        'default'           => 'Jason & Rachel',
                    ),

                    array(
                        'id'                => 'logo_image',
                        'type'              => 'media', 
                        'url'               => true,
                        'required'          => array('logo_type', 'equals', '2'),
                        'title'             => __('Image Logo', 'merit'),
                        'output'            => 'true',
                        'desc'              => __('Upload your logo or type the URL on the text box.', 'merit'),
                        'default'           => array('url'=>'http://s.wordpress.org/style/images/codeispoetry.png'),
                    ),

                    array(
                        'id'                =>'favicon',
                        'type'              => 'media', 
                        'title'             => __('Favicon', 'merit'),
                        'output'            => 'true',
                        'mode'              => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'              => __('Upload your favicon.', 'merit'),
                        'default'           => array('url' => get_stylesheet_directory_uri().'/images/favicon.png'),
                    ),

                    array(
                        'id'                        => 'custom_css',
                        'type'                      => 'ace_editor',
                        'title'                     => __('Custom CSS Codes', 'merit'),
                        'mode'                      => 'css',
                        'theme'                     => 'monokai',
                        'desc'                      => __('Type your custom CSS codes here, alternatively you can also write down you custom CSS styles on the custom.css file located on the theme root directory.', 'merit'),
                        'default'                   => ''
                    ),
                 )
            );

            // Color Settings
            $this->sections[] = array(
                'icon'    => 'el-icon-brush',
                'title'   => __('Colors', 'merit'),
                'fields'  => array(
                    array(
                        'id'                    => 'link_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Main Link Color', 'merit'),
                        'active'                => false,
                        'output'                => array('a'),
                        'default'               => array(
                                                    'regular'  => '#000000',
                                                    'hover'    => '#9d0909',
                        )
                    ),

                    array(
                        'id'                    => 'sub_pages_header_background',
                        'type'                  => 'background',
                        'title'                 => __('Sub Pages Header Background', 'merit'),
                        'output'                => array('.page-title'),
                        'preview'               => true,
                        'preview_media'         => true,
                        'background-repeat'     => true,
                        'background-attachment' => true,
                        'background-position'   => true,
                        'background-image'      => true,
                        'background-gradient'   => true,
                        'background-clip'       => true,
                        'background-origin'     => true,
                        'background-size'       => true,
                        'default'               => array(
                                                    'background-color'      => '#f9f9f9',
                                                )
                    ),

                    array(
                        'id'                    => 'footer_background',
                        'type'                  => 'background',
                        'title'                 => __('Footer Background', 'merit'),
                        'output'                => array('footer#footer'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => true,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color'      => '#f9f9f9',
                                                )
                    ),

                    array(
                        'id'                    => 'footer_link_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Footer Link Color', 'merit'),
                        'active'                => false,
                        'output'                => array('#footer a'),
                        'default'               => array(
                                                    'regular'  => '#000000',
                                                    'hover'    => '#b60606',
                        )
                    ),

                    array(
                        'id'                    => 'divider_color_menu',
                        'type'                  => 'info',
                        'icon'                  => 'el-icon-info-sign',
                        'title'                 => __('Menu Settings', 'merit'),
                        'desc'                  => __('Menu color settings.', 'merit'),
                    ),

                    array(
                        'id'                    => 'menu_bg_color',
                        'type'                  => 'background',
                        'title'                 => __('Main Menu Background', 'merit'),
                        'output'                => array('nav#main-menu', 'nav#main-menu ul.sub-menu', 'nav#main-menu ul li ul li'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => true,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color'      => '#ffffff',
                                                )
                    ),

                    array(
                        'id'                    => 'menu_bg_opacity',
                        'type'                  => 'slider',
                        'title'                 => __('Main Menu Opacity Value', 'merit'),
                        'default'               => .9,
                        'min'                   => .5,
                        'step'                  => .1,
                        'max'                   => 1,
                        'resolution'            => 0.1,
                        'display_value'         => 'text'
                    ),

                    array(
                        'id'                    => 'menu_link_color',
                        'type'                  => 'link_color',
                        'title'                 => __('Menu Link Color', 'merit'),
                        'desc'                  => __('Link color for main menu in the header and when the page is scrolled.', 'merit'),
                        'active'                => false,
                        'output'                => array('nav#main-menu ul li a', 'nav#main-menu.fixed ul li a', 'body.home nav#main-menu.fixed ul li a'),
                        'default'               => array(
                                                'regular'  => '#333333',
                                                'hover'    => '#b60606',
                        )
                    ),

                    array(
                        'id'                        => 'menu_border_color',
                        'type'                      => 'border',
                        'title'                     => __('Menu Border Border', 'merit'),
                        'output'                    => array('nav#main-menu', 'nav#main-menu ul.sub-menu'),
                        'all'                       => true,
                        'default'                   => array(
                            'border-color'          => '#dddddd',
                            'border-style'          => 'solid',
                            'border-width'          => '1', 
                        )
                    ),

                    array(
                        'id'                => 'divider_color_post',
                        'type'              => 'info',
                        'icon'              => 'el-icon-info-sign',
                        'title'             => __('Post Settings', 'merit'),
                        'desc'              => __('Post color settings.', 'merit'),
                    ),

                    array(
                        'id'                    => 'page_title_border',
                        'type'                  => 'background',
                        'title'                 => __('General Widget & Page Title Border Color', 'merit'),
                        'output'                => array('.home-widget .section-title:after', '.page-title h1:after'),
                        'preview'               => false,
                        'preview_media'         => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color'      => '#dddddd',
                                                )
                    ),

                    array(
                        'id'                => 'breadcrumb_link_color',
                        'type'              => 'link_color',
                        'title'             => __('Breadcrumb Link Color', 'merit'),
                        'active'            => false,
                        'output'            => array('.breadcrumbs a'),
                        'default'           => array(
                                                'regular'  => '#555555',
                                                'hover'    => '#b60606',
                        )
                    ),

                    array(
                        'id'                        => 'post_box_border',
                        'type'                      => 'border',
                        'title'                     => __('Post Grid Border', 'merit'),
                        'desc'                     => __('Border for post grid such as the ones in Events and Blog sections.', 'merit'),
                        'output'                    => array('.post-grid article.hentry .post-content', '.timeline article.type-history .post-wrapper'),
                        'all'                       => true,
                        'default'                   => array(
                            'border-color'          => '#dddddd',
                            'border-style'          => 'solid',
                            'border-width'          => '1', 
                        )
                    ),

                    array(
                        'id'                => 'divider_color_form',
                        'type'              => 'info',
                        'icon'              => 'el-icon-info-sign',
                        'title'             => __('Form Settings', 'merit'),
                        'desc'              => __('Form color settings.', 'merit'),
                    ),

                    array(
                        'id'                    => 'text_field_bg_color',
                        'type'                  => 'background',
                        'title'                 => __('Text Input Background', 'merit'),
                        'output'                => array('form .form-control'),
                        'preview'               => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'               => array(
                                                    'background-color'      => '#ffffff',
                                                )
                    ),

                    array(
                        'id'                        => 'text_field_border_color',
                        'type'                      => 'border',
                        'title'                     => __('Text Input Border', 'merit'),
                        'output'                    => array('form .form-control'),
                        'all'                       => true,
                        'default'                   => array(
                            'border-color'          => '#cccccc',
                            'border-style'          => 'solid',
                            'border-width'          => '1', 
                        )
                    ),

                    array(
                        'id'                        => 'text_field_text_color',
                        'type'                      => 'color',
                        'title'                     => __('Text Input Text Color', 'merit'),
                        'output'                    => array('form .form-control'),
                        'default'                   => '#555555',
                        'validate'                  => 'color'
                    ),

                    array(
                        'id'                    => 'submit_button_bg_color',
                        'type'                  => 'background',
                        'title'                 => __('Button Background Color', 'merit'),
                        'output'                => array('form input[type="submit"]', 'form button', 'form .btn', '.form-submit input', 'a.btn'),
                        'preview'               => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                         'default'              => array(
                                                    'background-color'      => '#d93333',
                                                )
                    ),

                    array(
                        'id'                    => 'submit_button_bg_hover_color',
                        'type'                  => 'background',
                        'title'                 => __('Button Background Hover Color', 'merit'),
                        'output'                => array('form input[type="submit"]:hover', 'form button:hover', 'form .btn:hover', '.form-submit input:hover', 'a.btn:hover'),
                        'preview'               => false,
                        'background-repeat'     => false,
                        'background-attachment' => false,
                        'background-position'   => false,
                        'background-image'      => false,
                        'background-gradient'   => false,
                        'background-clip'       => false,
                        'background-origin'     => false,
                        'background-size'       => false,
                        'default'                  => array(
                                                    'background-color'      => '#e4441f',
                                                )
                    ),

                    array(
                        'id'                    => 'button_text_color',
                        'type'                  => 'color',
                        'title'                 => __('Button text Color', 'merit'),
                        'output'                => array('form input[type="submit"]', 'form button', 'form .btn', '.form-submit input', 'a.btn'),
                        'default'               => '#ffffff',
                        'validate'              => 'color'
                    ),
                 )
            );

                    // About the Couple Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('About the Couple Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                    => 'couple_background',
                                'type'                  => 'background',
                                'title'                 => __('Widget Background', 'merit'),
                                'output'                => array('section.about_couple'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'couple_section_title_border',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.about_couple .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#dddddd',
                                                        )
                            ),

                            array(
                                'id'                => 'couple_text_color',
                                'type'              => 'color',
                                'title'             => __('Text Color', 'merit'),
                                'output'            => array('.about_couple'),
                                'default'           => '#555555',
                                'validate'          => 'color'
                            ),

                            array(
                                'id'                    => 'couple_social_media_link',
                                'type'                  => 'link_color',
                                'title'                 => __('Socil Media Icon Link Color', 'merit'),
                                'active'                => false,
                                'output'                => array('.about_couple .social a'),
                                'default'               => array(
                                                            'regular'  => '#9e9e9e',
                                                            'hover'    => '#757575',
                                )
                            ),
                        )
                    );

                    // Countdown Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('Countdown Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                        => 'section-widget-countdown',
                                'type'                      => 'info',
                                'icon'                      => 'el-icon-info-sign',
                                'title'                     => __('Countdown Widget', 'merit'),
                                'desc'                      => __('Countdown widget color settings.', 'merit'),
                            ),

                            array(
                                'id'                    => 'countdown_background',
                                'type'                  => 'background',
                                'title'                 => __('Widget Background', 'merit'),
                                'output'                => array('.home-countdown'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => true,
                                'background-origin'     => true,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#333333',
                                                        )
                            ),

                            array(
                                'id'                => 'countdown_main_text_color',
                                'type'              => 'color',
                                'title'             => __('Widget Main Text Color', 'merit'),
                                'output'            => array('.home-countdown h2.section-title', '#countdown .number-container .text'),
                                'default'           => '#ffffff',
                                'validate'          => 'color'
                            ),

                            array(
                                'id'                    => 'countdown_section_title_bg',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.home-countdown .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'countdown_timer_text_color',
                                'type'                  => 'color',
                                'title'                 => __('Timer Box Text Color', 'merit'),
                                'output'                => array('#countdown .number-container .number'),
                                'default'               => '#ffffff',
                                'validate'              => 'color'
                            ),

                            array(
                                'id'                        => 'countdown_border',
                                'type'                      => 'border',
                                'title'                     => __('Countdown Border', 'merit'),
                                'output'                    => array('#countdown .number-container .number'),
                                'all'                       => true,
                                'default'                   => array(
                                    'border-color'          => '#ffffff',
                                    'border-style'          => 'solid',
                                    'border-width'          => '7', 
                                )
                            ),
                         )
                    );

                    // RSVP Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('RSVP Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                    => 'rsvp_background',
                                'type'                  => 'background',
                                'title'                 => __('Widget Background', 'merit'),
                                'output'                => array('section.home-rsvp'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'rsvp_section_title_border',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.home-rsvp .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#dddddd',
                                                        )
                            ),

                            array(
                                'id'                => 'rsvp_text_color',
                                'type'              => 'color',
                                'title'             => __('Text Color', 'merit'),
                                'output'            => array('.home-rsvp .section-title', '#rsvp-widget .text-rsvp p'),
                                'default'           => '#555555',
                                'validate'          => 'color'
                            ),
                        )
                    );

                    // Testimonials Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('Testimonials Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                    => 'testimonial_background',
                                'type'                  => 'background',
                                'title'                 => __('Testimonial Background', 'merit'),
                                'output'                => array('.home-testimonial'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'testimonial_section_title_border',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.home-testimonial .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#dddddd',
                                                        )
                            ),

                            array(
                                'id'                    => 'testimonial_quote_bubble_bg',
                                'type'                  => 'background',
                                'title'                 => __('Quote Bubble Background', 'merit'),
                                'output'                => array('.home-testimonial .testimonial .text'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                => 'testimonial_quote_text_color',
                                'type'              => 'color',
                                'title'             => __('Quote Bubble Text Color', 'merit'),
                                'output'            => array('.home-testimonial .testimonial .text'),
                                'default'           => '#555555',
                                'validate'          => 'color'
                            ),

                            array(
                                'id'                => 'testimonial_text_color',
                                'type'              => 'color',
                                'title'             => __('Text Color', 'merit'),
                                'output'            => array('.home-testimonial .text', '.home-testimonial .person-info', '.home-testimonial .person-info .relation'),
                                'default'           => '#555555',
                                'validate'          => 'color'
                            ),
                        )
                    );

                    // Events Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('Events Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                    => 'events_background',
                                'type'                  => 'background',
                                'title'                 => __('Events Background', 'merit'),
                                'output'                => array('.home-events'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'events_section_title_border',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.home-events .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#dddddd',
                                                        )
                            ),

                            array(
                                'id'                => 'events_text_color',
                                'type'              => 'color',
                                'title'             => __('Text Color', 'merit'),
                                'output'            => array('.home-widget h4.sub-title'),
                                'default'           => '#999999',
                                'validate'          => 'color'
                            ),

                            array(
                                'id'                    => 'events_grid_bg',
                                'type'                  => 'background',
                                'title'                 => __('Post Grid Background', 'merit'),
                                'output'                => array('.home-events .post-grid .post-content'),
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-gradient'   => false,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),
                        )
                    );

                    // Blog Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('Blog Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                    => 'blog_background',
                                'type'                  => 'background',
                                'title'                 => __('Blog Background', 'merit'),
                                'output'                => array('.home-blog'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'blog_section_title_border',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.home-blog .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#dddddd',
                                                        )
                            ),

                            array(
                                'id'                => 'blog_text_color',
                                'type'              => 'color',
                                'title'             => __('Text Color', 'merit'),
                                'output'            => array('.home-widget h4.sub-title'),
                                'default'           => '#999999',
                                'validate'          => 'color'
                            ),

                            array(
                                'id'                    => 'blog_grid_bg',
                                'type'                  => 'background',
                                'title'                 => __('Post Grid Background', 'merit'),
                                'output'                => array('.home-blog .post-grid .post-content'),
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-gradient'   => false,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),
                        )
                    );

                    // Couple Tweets Widget
                    $this->sections[] = array(
                        'icon'          => ' el-icon-file-alt',
                        'title'         => __('Couple Tweets Widget', 'merit'),
                        'subsection'    => true,
                        'fields'        => array(
                            array(
                                'id'                    => 'couple_tweets_background',
                                'type'                  => 'background',
                                'title'                 => __('Widget Background', 'merit'),
                                'output'                => array('.home-couple-tweets'),
                                'preview_media'         => true,
                                'background-repeat'     => true,
                                'background-attachment' => true,
                                'background-position'   => true,
                                'background-image'      => true,
                                'background-gradient'   => true,
                                'background-clip'       => false,
                                'background-origin'     => false,
                                'background-size'       => true,
                                'default'               => array(
                                                            'background-color'      => '#ffffff',
                                                        )
                            ),

                            array(
                                'id'                    => 'couple_tweets_title_border',
                                'type'                  => 'background',
                                'title'                 => __('Widget Title Border Color', 'merit'),
                                'output'                => array('.home-couple-tweets .section-title:after'),
                                'preview'               => false,
                                'preview_media'         => false,
                                'background-repeat'     => false,
                                'background-attachment' => false,
                                'background-position'   => false,
                                'background-image'      => false,
                                'background-size'       => false,
                                'default'               => array(
                                                            'background-color'      => '#dddddd',
                                                        )
                            ),

                            array(
                                'id'                => 'couple_tweets_text_color',
                                'type'              => 'color',
                                'title'             => __('Text Color', 'merit'),
                                'output'            => array('.home-couple-tweets .section-title', '.home-couple-tweets .heading', '.home-couple-tweets ul.tweets-lists p'),
                                'default'           => '#555555',
                                'validate'          => 'color'
                            ),

                            array(
                                'id'                => 'couple_tweets_link_color',
                                'type'              => 'link_color',
                                'title'             => __('Link Color', 'merit'),
                                'active'            => false,
                                'output'            => array('.home-couple-tweets ul.tweets-lists p a'),
                                'default'           => array(
                                                        'regular'  => '#04379e',
                                                        'hover'    => '#b60606',
                                )
                            ),
                        )
                    );


            // Typography Settings
            $this->sections[] = array(
                'icon'    => 'el-icon-text-width',
                'title'   => __('Typography', 'merit'),
                'fields'  => array(
                    array(
                        'id'                => 'divider_typography_overall',
                        'desc'              => __('Overall Typography', 'merit'),
                        'type'              => 'info'
                    ),

                    array(
                        'id'                => 'paragraph_text',
                        'type'              => 'typography',
                        'title'             => __('Paragraph Text', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => true,
                        'output'            => array('body'),
                        'default'           => array(
                            'font-family'       => 'Roboto',
                            'font-size'         => '14px',
                            'font-weight'       => '400',
                            'color'             => '#666666',
                            'line-height'       => '22px'
                        )
                    ),

                    array(
                        'id'                => 'text_logo',
                        'type'              => 'typography',
                        'title'             => __('Text Logo in  Homepage', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'text-align'        => false,
                        'line-height'       => false,
                        'output'            => array('body.home #logo .couplesname'),
                        'default'           => array(
                            'font-family'       => 'Great Vibes',
                            'font-size'         => '100px',
                            'font-weight'       => '400',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'text_below_logo',
                        'type'              => 'typography',
                        'title'             => __('Text Below Logo', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'text-align'        => false,
                        'line-height'       => false,
                        'text-transform'    => true,
                        'output'            => array('#logo .text'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '20px',
                            'font-weight'       => '300',
                            'color'             => '#ffffff',
                            'text-transform'    => 'uppercase'
                        )
                    ),

                    array(
                        'id'                => 'header_wedding_date',
                        'type'              => 'typography',
                        'title'             => __('Wedding Date in Header', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'text-align'        => false,
                        'line-height'       => false,
                        'output'            => array('#main-slider .overlay .wedding-date'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '18px',
                            'font-weight'       => '400',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'main_menu',
                        'type'              => 'typography',
                        'title'             => __('Main Menu', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'color'             => false,
                        'font-size'         => false,
                        'letter-spacing'    => true,
                        'line-height'       => false,
                        'text-align'        => false,
                        'output'            => array('nav#main-menu ul li a'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '12px',
                            'font-weight'       => '700',
                            'letter-spacing'    => '2px',
                        )
                    ),

                    array(
                        'id'                => 'post_meta',
                        'type'              => 'typography',
                        'title'             => __('Post Meta', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.meta'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '10px',
                            'font-weight'       => '400',
                            'color'             => '#444444'
                        )
                    ),

                    array(
                        'id'                => 'footer_text',
                        'type'              => 'typography',
                        'title'             => __('Footer Text', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('footer#footer'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '14px',
                            'font-weight'       => '400',
                            'color'             => '#555555'
                        )
                    ),

                    array(
                        'id'                => 'sidebar_widget_title',
                        'type'              => 'typography',
                        'title'             => __('Sidebar Widget Title', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.sidebar-heading'),
                        'default'           => array(
                            'font-family'       => 'Raleway',
                            'font-size'         => '14px',
                            'font-weight'       => '200',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'divider_typography_homepage',
                        'desc'              => __('Homepage Typography', 'merit'),
                        'type'              => 'info'
                    ),

                    array(
                        'id'                => 'homepage_widget_title',
                        'type'              => 'typography',
                        'title'             => __('Homepage Widget Title', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'letter-spacing'    => true,
                        'output'            => array('h2.section-title', '#comments .widget-title, #reply-title'),
                        'default'           => array(
                            'font-family'       => 'Raleway',
                            'font-size'         => '35px',
                            'font-weight'       => '800',
                            'text-align'        => 'center',
                            'color'             => '#333333',
                            'letter-spacing'    => '1px',
                        )
                    ),

                    array(
                        'id'                => 'homepage_widget_sub_title',
                        'type'              => 'typography',
                        'title'             => __('Homepage Sub Title', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.home-widget h4.sub-title'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '20px',
                            'font-weight'       => '400',
                            'color'             => '#999999',
                        )
                    ),

                    array(
                        'id'                => 'countdown_timer',
                        'type'              => 'typography',
                        'title'             => __('Countdown Timer', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#countdown .number-container .number'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '45px',
                            'font-weight'       => '800',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'countdown_timer_unit',
                        'type'              => 'typography',
                        'title'             => __('Countdown Time Units', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#countdown .number-container .text'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '15px',
                            'font-weight'       => '400',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'couple_name_font',
                        'type'              => 'typography',
                        'title'             => __('Couple Names', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.about_couple .couple h2'),
                        'default'           => array(
                            'font-family'       => 'Great Vibes',
                            'font-size'         => '45px',
                            'font-weight'       => '300',
                            'color'             => '#555555'
                        )
                    ),

                    array(
                        'id'                => 'couple_name_and_font',
                        'type'              => 'typography',
                        'title'             => __('Couple Names '&' Separator', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.about_couple .and'),
                        'default'           => array(
                            'font-family'       => 'Great Vibes',
                            'font-size'         => '120px',
                            'font-weight'       => '300',
                            'color'             => '#ddd'
                        )
                    ),
                    
                    array(
                        'id'                => 'divider_typography_post_detail',
                        'desc'              => __('Post Detail Typography', 'merit'),
                        'type'              => 'info'
                    ),

                    array(
                        'id'                => 'post_title',
                        'type'              => 'typography',
                        'title'             => __('Post Title', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'output'            => array('.single-page .post-title'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '50px',
                            'font-weight'       => '700',
                            'line-height'       => '60px',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'archive_post_title',
                        'type'              => 'typography',
                        'title'             => __('Archive Post Title', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.page-title h1'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '36px',
                            'font-weight'       => '700',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'breadcrumb',
                        'type'              => 'typography',
                        'title'             => __('Breadcrumb', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('div.breadcrumb'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '11px',
                            'font-weight'       => '400',
                            'color'             => '#999999'
                        )
                    ),

                    array(
                        'id'                => 'blockquote_font',
                        'type'              => 'typography',
                        'title'             => __('Blockquote', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'font-style'        => true,
                        'output'            => array('blockquote'),
                        'default'           => array(
                            'font-family'       => 'Noto Serif',
                            'font-size'         => '25px',
                            'font-weight'       => '400',
                            'font-style'        => 'italic',
                            'color'             => '#555555'
                        )
                    ),

                    array(
                        'id'                => 'post-h1',
                        'type'              => 'typography',
                        'title'             => __('H1 Heading', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#leftcol h1', '.content.full h1'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '50px',
                            'font-weight'       => '700',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'post-h2',
                        'type'              => 'typography',
                        'title'             => __('H2 Heading', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#leftcol h2', '.content.full h2'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '30px',
                            'font-weight'       => '700',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'post-h3',
                        'type'              => 'typography',
                        'title'             => __('H3 Heading', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#leftcol h3', '.content.full h3'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '25px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'post-h4',
                        'type'              => 'typography',
                        'title'             => __('H4 Heading', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#leftcol h4', '.content.full h4'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '20px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'post-h5',
                        'type'              => 'typography',
                        'title'             => __('H5 Heading', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#leftcol h5', '.content.full h5'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '16px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'post-h6',
                        'type'              => 'typography',
                        'title'             => __('H6 Heading', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('#leftcol h6', '.content.full h6'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#000000'
                        )
                    ),

                    array(
                        'id'                => 'submit_button',
                        'type'              => 'typography',
                        'title'             => __('Submit Button', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.form-submit input'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '14px',
                            'font-weight'       => '700',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'add_comment_meta( $comment_id, $meta_key, $meta_value, $unique );',
                        'type'              => 'typography',
                        'title'             => __('Comment Meta', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.comments .meta'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '10px',
                            'font-weight'       => '400',
                            'color'             => '#444444'
                        )
                    ),

                    array(
                        'id'                => 'comment_moderation_text',
                        'type'              => 'typography',
                        'title'             => __('Comment Moderation Text', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.comment-waiting p'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '14px',
                            'font-weight'       => '400',
                            'font-style'        => 'italic',
                            'color'             => '#ff0000'
                        )
                    ),

                    array(
                        'id'                => 'divider_typography_gallery',
                        'desc'              => __('Gallery Typography', 'merit'),
                        'type'              => 'info'
                    ),

                    array(
                        'id'                => 'gallery_filter',
                        'type'              => 'typography',
                        'title'             => __('Gallery Filter', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'letter-spacing'    => true,
                        'output'            => array('.filter-holder a'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '12px',
                            'font-weight'       => '400',
                            'color'             => '#555555',
                            'letter-spacing'    => '2px'
                        )
                    ),

                    array(
                        'id'                => 'gallery_hover_title',
                        'type'              => 'typography',
                        'title'             => __('Gallery Hover Title', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('ul.gallery li .overlay a'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '14px',
                            'font-weight'       => '700',
                            'color'             => '#ffffff'
                        )
                    ),

                    array(
                        'id'                => 'divider_typography_testimonial',
                        'desc'              => __('Testimonial Typography', 'merit'),
                        'type'              => 'info'
                    ),

                    array(
                        'id'                => 'testimonial_content',
                        'type'              => 'typography',
                        'title'             => __('Testimonial Content', 'merit'),
                        'google'            => true,
                        'subsets'           => true,
                        'preview'           => true,
                        'line-height'       => false,
                        'output'            => array('.testimonial div.quote'),
                        'default'           => array(
                            'font-family'       => 'Open Sans',
                            'font-size'         => '16px',
                            'font-style'        => 'italic',
                            'font-weight'       => '400',
                            'color'             => '#555555'
                        )
                    ),
                )
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'merit_option',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'merit'),
                'page_title'        => __('Theme Options', 'merit'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'    => 'AIzaSyDM81TyGQY8jEQykIWxXp1EnuKHOGe3ULA', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => 61,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon' => get_template_directory_uri() .'/images/warrior-icon.png', // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => 'warriorpanel',              // Page slug used to denote the panel
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
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/themewarrior',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/themewarrior',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://themeforest.net/user/ThemeWarriors/portfolio',
                'title' => 'See our portfolio',
                'icon' => 'el-icon-check'
            );

            // Panel Intro text -> before the form
                $this->args['intro_text'] = __('<p>If you like this theme, please consider giving it a 5 star rating on ThemeForest. <a href="http://themeforest.net/downloads" target="_blank">Rate now</a>.</p>', 'redux-framework-demo');

            // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}