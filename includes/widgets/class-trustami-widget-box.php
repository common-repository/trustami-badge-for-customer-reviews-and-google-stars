<?php

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

/**
 * A simple widget for adding the Trustami Badge to your shop
 *
 * @since 1.0
 * @extends \WP_Widget
 */

class WC_Trustami_Widget_Box extends WP_Widget {

    /**
     * Setup the widget options
     *
     * @since 1.0
     */
    public function __construct() {

        // set widget options
        $options = array(
            'classname' => 'widget_trustami_box', // CSS class name
            'description' => __('Trustami Box Widget.', 'trustami-badge-for-customer-reviews-and-google-stars'),
        );

        // instantiate the widget
        parent::__construct('WC_Trustami_Widget_Box', __('Trustami Trust Badge Box', 'trustami-badge-for-customer-reviews-and-google-stars'), $options);
    }

    /**
     * Render the widget
     *
     * @since 1.0
     * @see WP_Widget::widget()
     * @param array $args
     * @param array $instance
     */
    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="widget_container_box"></div>';
        echo $args['after_widget'];
    }

    /**
     * Update the widget title & selected product
     *
     * @since 1.0
     * @see WP_Widget::update()
     * @param array $new_instance new widget settings
     * @param array $old_instance old widget settings
     * @return array updated widget settings
     */
    public function update($new_instance, $old_instance) {
        return $new_instance;
    }

    /**
     * Render the admin form for the widget
     *
     * @since 1.0.0
     * @see WP_Widget::form()
     * @param array $instance the widget settings
     * @return string|void
     */
    public function form($instance) {
        ?>
            <p>
                <h4><b><?php _e('Done.', 'trustami-badge-for-customer-reviews-and-google-stars'); ?></b></h4>
                <span type="text" class="widefat">
                    <?php
                        _e('Success: the Trustami badge has been added.', 'trustami-badge-for-customer-reviews-and-google-stars');
                    ?>
                </span>
            </p>
        <?php
    }

}

/**
 * Registers the new widget to add it to the available widgets
 *
 * @since 1.0.0
 */
function wc_trustami_register_box_widget() {
    register_widget('WC_Trustami_Widget_Box');
}
add_action('widgets_init', 'wc_trustami_register_box_widget');
