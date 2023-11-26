<?php
/*
Plugin Name: Creative Text Effect 
Description: Transform your WordPress website with the Creative Text plugin, bringing a touch of cyber style to your content.
Version: 1.0
Author: Hassan Naqvi
*/

// Include other PHP files or configurations if needed
include(plugin_dir_path(__FILE__) . 'includes/page-option.php');

// Enqueue scripts and styles
function creative_text_shifter_enqueue_scripts() {
    // Enqueue style.css from the root directory with a higher priority (e.g., 999)
    wp_enqueue_style('creative-text-shifter-style', plugins_url('style.css', __FILE__), array(), '1.0', 'all');
	
    // Enqueue script.js from the root directory
    wp_enqueue_script('creative-text-shifter-script', plugins_url('script.js', __FILE__), array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'creative_text_shifter_enqueue_scripts', 999);

// Register the shortcode
function creative_text_shifter_shortcode_function($atts) {
    // Extract shortcode attributes
    $atts = shortcode_atts(
        array(
            'text' => 'HYPERPLEXED',
            'font_size' => '16px',
            'text_align' => 'left', // Default text-align is left
            'link' => '#', // Default link is #
        ),
        $atts,
        'creative_text_shifter_shortcode'
    );

    // Sanitize input
    $text = sanitize_text_field($atts['text']);
    $font_size = sanitize_text_field($atts['font_size']);
    $text_align = sanitize_text_field($atts['text_align']);
    $link = esc_url($atts['link']); // Sanitize and escape the URL

    // Generate HTML with provided parameters
    $output = "<h2 class='hyp' style='font-size: {$font_size}; text-align: {$text_align}'>";
    $output .= "<a href='{$link}' data-value='{$text}'>{$text}</a>";
    $output .= "</h2>";

    // Enqueue the script
    add_action('wp_footer', 'creative_text_shifter_enqueue_custom_script');

    return $output;
}

// Register the shortcode hook
add_shortcode('cyber_effect', 'creative_text_shifter_shortcode_function');

// Enqueue custom script for the shortcode
function creative_text_shifter_enqueue_custom_script() {
    ?>
    <script>
        const letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        document.addEventListener("mouseover", function(event) {
            if (event.target.matches("h2.hyp a")) {
                let iteration = 0;

                clearInterval(event.target.interval);

                event.target.interval = setInterval(() => {
                    event.target.innerText = event.target.innerText
                        .split("")
                        .map((letter, index) => {
                            if (index < iteration) {
                                return event.target.dataset.value[index];
                            }

                            return letters[Math.floor(Math.random() * 26)];
                        })
                        .join("");

                    if (iteration >= event.target.dataset.value.length) {
                        clearInterval(event.target.interval);
                    }

                    iteration += 1 / 3;
                }, 30);
            }
        });
    </script>
    <?php
}
