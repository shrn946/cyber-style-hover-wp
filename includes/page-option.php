<?php

// Function to display the settings page content
function creative_text_shifter_settings_page() {
    ?>
    <div class="wrap">
        <h2>Creative Text Effect  WordPress</h2>
        <p>Activate the plugin in your WordPress admin panel.</p>
        <p>Now, you can use the shortcode <code>[cyber_effect]</code> in your WordPress posts or pages. You can also customize the text and font size using attributes like this:</p>

        <pre>[cyber_effect text="Book your Table" font_size="20px" text_align="center" link="#"]</pre>

    
</pre>
    </div>
     <?php
}

// Function to add the settings page to the admin menu
function creative_text_shifter_add_menu() {
    add_options_page('Creative Text Shifter Settings', 'Creative Text Shifter Effect', 'manage_options', 'creative-text-shifter-settings', 'creative_text_shifter_settings_page');
}

// Hook to add the settings page
add_action('admin_menu', 'creative_text_shifter_add_menu');
