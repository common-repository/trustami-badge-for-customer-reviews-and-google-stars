<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class WC_Trustami_Settings_Tab {

    /**
     * Bootstraps the class and hooks required actions & filters.
     *
     */
    public static function init() {
        add_filter('woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50);
        add_action('woocommerce_settings_tabs_trustami_settings_tab', __CLASS__ . '::settings_tab');
        add_action('woocommerce_update_options_trustami_settings_tab', __CLASS__ . '::update_settings');
    }

    /**
     * Add a new settings tab to the WooCommerce settings tabs array.
     *
     * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Subscription tab.
     * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Subscription tab.
     */
    public static function add_settings_tab($settings_tabs) {
        $settings_tabs['trustami_settings_tab'] = __('Trustami', 'trustami-badge-for-customer-reviews-and-google-stars');
        return $settings_tabs;
    }

    /**
     * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
     *
     * @uses woocommerce_admin_fields()
     * @uses self::get_settings()
     */
    public static function settings_tab() {
        woocommerce_admin_fields(self::get_settings());
    }

    /**
     * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
     *
     * @uses woocommerce_update_options()
     * @uses self::get_settings()
     */
    public static function update_settings() {
        woocommerce_update_options(self::get_settings());
    }

    /**
     * Get all the settings for this plugin for @see woocommerce_admin_fields() function.
     *
     * @return array Array of settings for @see woocommerce_admin_fields() function.
     */
    public static function get_settings() {
        $settings = array(
            'section_title' => array(
                'name' => __('Trustami Widget Configuration', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'title',
                'desc' => '',
                'id' => 'WC_Trustami_Settings_Tab_section_title'
            ),
            'trustami_profile_id' => array(
                'name' => __('Trustami ID', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'text',
                'custom_attributes' => array( 'required' => 'required' ),
                'desc' => __('Your Trustami ID can be found in your user account at app.trustami.com under the Settings menu option.', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'desc_tip' => true,
                'id' => 'WC_Trustami_Settings_Tab_trustami_profile_id',
                'css' => 'min-width:250px;'
            ),
            'section_end1' => array(
                'type' => 'sectionend',
                'id' => 'WC_Trustami_Settings_Tab_section_end1'
            ),
            'section_title_2' => array(
                'name' => __('Trust Badge Position', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'title',
                'desc' => __( '<ins><i>Hint</ins>:</i> If the selected trust badge is not displayed, it can be activated by logging in to <a href="https://app.trustami.com/start/woocommerce/en" target="_blank">app.trustami.com</a>', 'trustami-badge-for-customer-reviews-and-google-stars' ),
                'id' => 'WC_Trustami_Settings_Tab_section_title_2'
            ),
            'trustami_header_display' => array(
                'name' => __('Display in the header', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'select',
                'class'  => 'chosen_select',
                'options' => array(
                    '4' => __('Trust Badge Standard', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '3' => __('Trust Badge Mini (recommended)', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '2' => __('Trust Badge Box', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '1' => __('Deactivated', 'trustami-badge-for-customer-reviews-and-google-stars')
                ),
                'id' => 'WC_Trustami_Settings_Tab_trustami_header_display',
                'css' => 'min-width:200px;',
                'default' => '1'
            ),
            'trustami_product_display' => array(
                'name' => __('Display in the product description', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'select',
                'class'  => 'chosen_select',
                'options' => array(
                    '4' => __('Trust Badge Standard', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '3' => __('Trust Badge Mini', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '2' => __('Trust Badge Box (recommended)', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '1' => __('Deactivated', 'trustami-badge-for-customer-reviews-and-google-stars')
                ),
                'id' => 'WC_Trustami_Settings_Tab_trustami_product_display',
                'css' => 'min-width:200px;',
                'default' => '1'
            ),
            'trustami_footer_display' => array(
                'name' => __('Display in the footer', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'select',
                'class'  => 'chosen_select',
                'options' => array(
                    '5' => __('Trust Badge Comments', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '4' => __('Trust Badge Standard (recommended)', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '3' => __('Trust Badge Mini', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '2' => __('Trust Badge Box', 'trustami-badge-for-customer-reviews-and-google-stars'),
                    '1' => __('Deactivated', 'trustami-badge-for-customer-reviews-and-google-stars')
                ),
                'id' => 'WC_Trustami_Settings_Tab_trustami_footer_display',
                'css' => 'min-width:200px;',
                'default' => '4'
            ),
            'text_badge' => array(
                'name' => __('Display trust badge text in the footer', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '1',
                'id' => 'WC_Trustami_Settings_Tab_text_badge'
            ),
            'overlay_badge' => array(
                'name' => __('Display trust badge overlay', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '1',
                'id' => 'WC_Trustami_Settings_Tab_overlay_badge'
            ),
            'overlay_frame' => array(
                'name' => __('Display trust badge frame', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '1',
                'id' => 'WC_Trustami_Settings_Tab_overlay_frame'
            ),
            'overlay_list' => array(
                'name' => __('Display trust badge list', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '1',
                'id' => 'WC_Trustami_Settings_Tab_overlay_list'
            ),
            'overlay_sticker' => array(
                'name' => __('Display trust badge sticker', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '1',
                'id' => 'WC_Trustami_Settings_Tab_overlay_sticker'
            ),
            'overlay_button' => array(
                'name' => __('Display trust badge button', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '0',
                'id' => 'WC_Trustami_Settings_Tab_overlay_button'
            ),
            'overlay_social' => array(
                'name' => __('Display trust badge social', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '0',
                'id' => 'WC_Trustami_Settings_Tab_overlay_social'
            ),
            'overlay_duo' => array(
                'name' => __('Display trust badge duo', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '0',
                'id' => 'WC_Trustami_Settings_Tab_overlay_duo'
            ),
            'overlay_stars' => array(
                'name' => __('Display trust badge stars', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '0',
                'id' => 'WC_Trustami_Settings_Tab_overlay_stars'
            ),
            'overlay_shopak' => array(
                'name' => __('Display Shopauskunft trust badge', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'checkbox',
                'default' => '0',
                'id' => 'WC_Trustami_Settings_Tab_overlay_shopak'
            ),
            'cus_data_att' => array(
                'name' => __('Custom Data Attribute', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'type' => 'text',
                'desc' => __('For more information please contact our Trustami support team.', 'trustami-badge-for-customer-reviews-and-google-stars'),
                'desc_tip' => true,
                'id' => 'WC_Trustami_Settings_Tab_cus_data_att',
                'css' => 'min-width:250px;'
            ),
            'section_end' => array(
                'type' => 'sectionend',
                'id' => 'WC_Trustami_Settings_Tab_section_end'
            )
        );

        return apply_filters('WC_Trustami_Settings_Tab_settings', $settings);
    }

}
