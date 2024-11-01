<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Trustami
 * @subpackage Trustami/public
 * @author     Trustami GmbH <https://www.trustami.com>
 */
class Trustami_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() { }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() { }

    function returnTrustamiFooterCnt() {
        $opts = get_option('WC_Trustami_Settings_Tab_trustami_profile_id');
        if(!empty($opts)){
            $footerCtn = "";

            $footerHtml = $this->trustamiDiv(get_option('WC_Trustami_Settings_Tab_trustami_footer_display'),"footer");
            if($footerHtml)
                $footerCtn = $footerHtml;

            $footerTextBadge = get_option('WC_Trustami_Settings_Tab_text_badge');
            if($footerTextBadge == "yes")
                $footerCtn ='<div class="widget_container_text_only" style="text-align: center;"></div>'.$footerCtn;

            $footerSticker = get_option('WC_Trustami_Settings_Tab_overlay_sticker');
            if($footerSticker == "yes")
                $footerCtn ='<div class="widget_container_overlay_sticker" style="text-align: center;"></div>'.$footerCtn;

            $footerButton = get_option('WC_Trustami_Settings_Tab_overlay_button');
            if($footerButton == "yes")
                $footerCtn ='<div class="widget_container_simple_badge" style="text-align: center;"></div>'.$footerCtn;
            
            $footerSocial = get_option('WC_Trustami_Settings_Tab_overlay_social');
            if($footerSocial == "yes")
                $footerCtn ='<div class="widget_container_social_badge" style="text-align: center;"></div>'.$footerCtn;
            
            $footerDuo = get_option('WC_Trustami_Settings_Tab_overlay_duo');
            if($footerDuo == "yes")
                $footerCtn ='<div class="widget_container_combi_badge" style="text-align: center;"></div>'.$footerCtn;

            $footerShopak = get_option('WC_Trustami_Settings_Tab_overlay_shopak');
            if($footerShopak == "yes")
                $footerCtn ='<div class="widget_container_shopauskunft" style="text-align: center;"></div>'.$footerCtn;

            $footerStars = get_option('WC_Trustami_Settings_Tab_overlay_stars');
            if($footerStars == "yes")
                $footerCtn ='<div class="widget_container_stars_badge" style="text-align: center;"></div>'.$footerCtn;

            $options = array(
                    "profileId" => $opts,
                    "textBadge" => get_option('WC_Trustami_Settings_Tab_text_badge'),
                    "overlayBadge" => get_option('WC_Trustami_Settings_Tab_overlay_badge'),
                    "overlayFrame" => get_option('WC_Trustami_Settings_Tab_overlay_frame'),
                    "overlayList" => get_option('WC_Trustami_Settings_Tab_overlay_list'),
                    "overlaySticker" => get_option('WC_Trustami_Settings_Tab_overlay_sticker'),
                    "overlayButton" => get_option('WC_Trustami_Settings_Tab_overlay_button'),
                    "overlaySocial" => get_option('WC_Trustami_Settings_Tab_overlay_social'),
                    "overlayDuo" => get_option('WC_Trustami_Settings_Tab_overlay_duo'),
                    "cusDataAtt" => get_option('WC_Trustami_Settings_Tab_cus_data_att')
                );

            $footerCtn.= '<script>let taScript = document.createElement("script");
            taScript.setAttribute("type", "text/javascript");
            taScript.setAttribute("id", "trustamiwidget");
            taScript.setAttribute("src", "https://cdn.trustami.com/widgetapi/widget2/trustami-widget.js?cache=off");
            taScript.setAttribute("data-user", "31ae1621831be5333185d875512bf5e52c480452");
            taScript.setAttribute("data-profile", "'.$options["profileId"].'");
            taScript.setAttribute("data-platform", "0");
            taScript.setAttribute("data-plugin", "wc");';

            if (!empty($options["cusDataAtt"])) {
            $footerCtn.= 'taScript.setAttribute("data-custom", "'.urlencode($options["cusDataAtt"]).'");
            let ta_parsed_json = JSON.parse(\''.$options["cusDataAtt"].'\');
            for (let property in ta_parsed_json) {
                if (ta_parsed_json[property] !== undefined) {
                    taScript.setAttribute(property, ta_parsed_json[property]);
                }
            }';
            }

            $footerCtn.= 'document.body.appendChild(taScript);</script>';
            if (!empty($footerCtn))
            echo $footerCtn;
        }

    }

    function returnTrustamiHeaderCnt() {
        $opts = get_option('WC_Trustami_Settings_Tab_trustami_profile_id');
        if(!empty($opts)){
            $headerHtml = $this->trustamiDiv(get_option('WC_Trustami_Settings_Tab_trustami_header_display'),"header");
            if($headerHtml)
                echo $headerHtml;
        }
    }
    function returnTrustamiCategoryCnt($html)  {
        $opts = get_option('WC_Trustami_Settings_Tab_trustami_profile_id');
        if(!empty($opts)){
            $catHtml = $this->trustamiDiv(get_option('WC_Trustami_Settings_Tab_trustami_product_display'),"productDesc");
            if($catHtml)
                return $html.$catHtml;
            else return $html;
        }
        return $html;
    }

    function trustamiDiv($choice,$position){
      $centerStl = ".trustami_centered {text-align: center; margin: 0 auto;}";
      $boxBadgeStl = " .widget_container_box, .widget_container_badge{ margin-top:10px;margin-bottom:10px;}";
      $idStl = " div#trustami_footer.widget_container, div#trustami_footer.widget_container_comments_badge, div#trustami_productDesc.widget_container, div#trustami_productDesc.widget_container_comments_badge{margin-top:10px;margin-bottom:10px;}";

    switch ($choice){
        case "5":
            return '<style>'.$idStl.'</style>'.'<div class="widget_container_comments_badge" id="trustami_'.$position.'"></div>';
        break;
        case "4":
            return '<style>'.$idStl.'</style>'.'<div class="widget_container" id="trustami_'.$position.'"></div>';
        break;
        case "3":
            return '<style>'.$centerStl.$boxBadgeStl.$idStl.'</style>'.'<div class="widget_container_badge trustami_centered" id="trustami_'.$position.'"></div>';
        break;
        case "2":
            return '<style>'.$centerStl.$boxBadgeStl.$idStl.'</style>'.'<div class="widget_container_box trustami_centered" id="trustami_'.$position.'"></div>';
        break;
        default://do nothing
            return null;
        }
    }
}
