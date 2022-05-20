<?php

function remove_unused_scripts() {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('mediaelement');
    wp_dequeue_style('wp-mediaelement');
    wp_dequeue_style('wpcf7-redirect-script-frontend');

    if (class_exists('WooCommerce')) {
        if (!is_woocommerce() && !is_cart() && !is_checkout()) {
            wp_dequeue_style('wc-blocks-vendors-style');
            wp_dequeue_style('wc-blocks-style');
            wp_dequeue_style('woocommerce-inline');
            wp_dequeue_style('woocommerce-layout');
            wp_dequeue_style('woocommerce-smallscreen');
            wp_dequeue_style('woocommerce-general');
            wp_dequeue_script('jquery-blockui');
            wp_dequeue_script('wc-add-to-cart');
            wp_dequeue_script('wc-cart-fragments-js');
            wp_dequeue_script('wc-cart-fragments');
            wp_dequeue_script('woocommerce-js');
            wp_dequeue_script('woocommerce');
        }
    }
}
add_action('wp_enqueue_scripts', 'remove_unused_scripts');

function remove_scripts() {
    if (!is_admin()) {
        //wp_deregister_script('lodash');
        wp_deregister_script('lodash-js-after');
        //wp_deregister_script('wp-polyfill');
        wp_deregister_script('wp-embed');
    }

    // Remove the REST API endpoint.
    remove_action('rest_api_init', 'wp_oembed_register_route');

    // Turn off oEmbed auto discovery.
    add_filter('embed_oembed_discover', '__return_false');

    // Don't filter oEmbed results.
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

    // Remove oEmbed discovery links.
    remove_action('wp_head', 'wp_oembed_add_discovery_links');

    // Remove oEmbed-specific JavaScript from the front-end and back-end.
    remove_action('wp_head', 'wp_oembed_add_host_js');
}
add_action('init', 'remove_scripts');

function add_async_attribute($tag, $handle) {
    $defer_scripts = array('regenerator-runtime', 'contact-form-7', 'google-recaptcha', 'wpcf7-recaptcha');
    $async_scripts = array('');
    $two_types = array('');

    if (!is_admin()) {
        if (!current_user_can("Administrator") || !current_user_can("Editor")) {
            if (in_array($handle, $defer_scripts)) return str_replace(' src', ' defer src', $tag);

            if (in_array($handle, $async_scripts)) return str_replace(' src', ' async src', $tag);

            if (in_array($handle, $two_types)) return str_replace(' src', ' defer async src', $tag);

            return $tag;
        }
    }

    return $tag;
}
add_filter('script_loader_tag', 'add_async_attribute', 10, 2);

function disable_emojis() {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
}

function disable_emojis_tinymce($plugins) {
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    }

    return array();
}
add_action('init', 'disable_emojis');

function max_upload_in_media($file) {
    // Cuando es imagen
    if (strpos($file['type'], 'image') !== false) {
        $image_data = getimagesize($file['tmp_name']);
        // 400kb
        if (($file['size'] * 0.0009765625) > 400) {
            $file['error'] = __('La imagen no debe ser mayor a 400kb.');
        } elseif (count($image_data) > 0) {
            // Width
            if ($image_data[0] > 2000) {
                $file['error'] = __('La resolución de la imagen no debe ser mayor a 1500px.');
            }

            return $file;
        }

        return $file;
    }

    return $file;
}
add_filter('wp_handle_upload_prefilter', 'max_upload_in_media', 10);
