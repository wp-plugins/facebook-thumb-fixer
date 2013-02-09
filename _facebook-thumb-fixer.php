<?php
/*
Plugin Name: Facebook Thumb Fixer
Plugin URI: http://www.thatwebguyblog.com/post/facebook-thumb-fixer-for-wordpress/
Description: Fixes the problem of the missing (or wrong) thumbnail when a post is shared on Facebook.
Author: Michael Ott
Version: 1.2.3
Author URI: http://www.thatwebguyblog.com
*/


// Add HELP link from the plugin page
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'link_action_on_plugin' );
function link_action_on_plugin( $links ) {
	return array_merge(array('settings' => '<a href="' . admin_url( '/options-general.php' ) . '">' . __( 'Settings', 'domain' ) . '</a> | <a href="' . admin_url( '/options-general.php?page=facebook-thumb-fixer' ) . '">' . __( 'Help', 'domain' ) . '</a>'), $links);
}

// Add field into the general settings page
$general_setting_default_fb_thumb = new general_setting_default_fb_thumb();
 
class general_setting_default_fb_thumb {
    function general_setting_default_fb_thumb( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    function register_fields() {
        register_setting( 'general', 'default_fb_thumb', 'esc_attr' );
        add_settings_field('fav_color', '<label for="default_fb_thumb">'.__('Default Facebook Thumb' , 'default_fb_thumb' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    function fields_html() {
        $fbt_value = get_option( 'default_fb_thumb', '' );
        echo '<input type="text" id="default_fb_thumb" class="regular-text ltr" name="default_fb_thumb" value="' . $fbt_value . '" /> <p class="description">This is the full path to your default Facebook thumb (Ideally 155 x 155px. Go <a href="' . admin_url( '/options-general.php?page=facebook-thumb-fixer' ) . '">here</a> for more information.)</p>';
		if ($fbt_value) {
		echo '<img src="' . $fbt_value . '" title="Default Facebook Thumb" />';
		}
    }
}


// Add page into the SETTINGS menu
add_action( 'admin_menu', 'ftfixer_menu' );
function ftfixer_menu() {
	add_options_page( 'Facebook Thumb Fixer Help', 'Facebook Thumb Fixer', 'manage_options', 'facebook-thumb-fixer', 'my_plugin_options' );
}
function my_plugin_options() {
	if ( !current_user_can( 'read' ) )  { // This help page is accessible to anyone
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>
	
<div class="wrap">
    <h2>Facebook Thumb Fixer - General Information</h2>
	<?php 
    $fbt_value = get_option( 'default_fb_thumb', '' );
    if ($fbt_value) { ?>
    <p style="background:url(<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/tick.png) no-repeat left; padding:0 0 0 20px;">You currently have a Default Facebook Thumbnail set. You can change it <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>.</p>
    <img src="<?php echo $fbt_value; ?>" alt="" />
    <?php } else { ?>
    <p style="background:url(<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/cross.png) no-repeat left; padding:0 0 0 20px;">You currently do not have a Default Facebook Thumbnail set. Set one <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>. Ideally this would be a 155 x 155px image of your logo or brand.</p>
    <?php } ?>
    <h3>Help Topics</h3>
    <ul>
    	<li><a href="#topic01">What does this plugin do?</a></li>
        <li><a href="#topic02">How does it work?</a></li>
        <li><a href="#topic03">What if you don't use Featured Images on your posts?</a></li>
        <li><a href="#topic04">What if some posts use featured images and some don't?</a></li>
        <li><a href="#topic05">Occasionally it doesn't work. What's going on?</a></li>
        <li><a href="#topic06">Where can I get support and discuss this plugin?</a></li>
    </ul>
    
    <h3 id="topic01" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">What does this plugin do?</h3>
    <p>This plugin will place the appropriate Facebook <a href="https://developers.facebook.com/docs/concepts/opengraph/" target="_blank">Open Graph</a> meta properties into the &lt;head&gt; of your web pages, so that when someone links to your page on Facebook the correct thumbnail will show. The thumbnail is derived from the featured image of your post (or page). For example:</p>
    <p><img src="<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/sample-post.png" alt="" /></p>
    <p>If your post does not have a featured image, then the default thumbnail will take over. For example:</p>
    <p><img src="<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/sample-post-default.png" alt="" /></p>
    <p>If someone links to your homepage (which traditionally doesn't have a featured image) then the default image is also used here.</p>
    <img src="<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/sample-home.png" alt="" /></p>
    <h3 id="topic02" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">How does it work?</h3>
    <p>Whenever anyone posts a website link to Facebook, the Facebook system searches the source code for their <a href="https://developers.facebook.com/docs/concepts/opengraph/" target="_blank">Open Graph</a> og:image meta property. If it is not found, then it will instead pull (several) images (if any) contained within the webpage. If there are multiple images pulled then the user can select one of the many presented (though the one they choose might not be the one you are happy to have as the primary image shown on Facebook, hence this plugin).</p>
    <p>This plugin gets around that problem but taking  that choice away from the Facebook user, so only the thumbnail you want is displayed. This is also good in a situation where - for example - many different Facebook users share your web page,  you can trust the same thumbnail will always be used.</p>
    <p>This plugin inserts the og:image meta property into the &lt;head&gt; of your website and pulls the featured image for any post. For those interested, the code output looks like something this:</p>
    <pre style='padding:5px;background:#f1f1f1;display:inline;'>&lt;meta property="og:image" content="<?php echo get_option('home'); ?>/wp-content/uploads/year/month/featured-image-name.png" /&gt;</pre>
    <p>This will be the image that is used when anyone adds a link to your post on Facebook</p>
    <h3 id="topic03" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">What if you don't use Featured Images on your posts?</h3>
    <p>If you don't have featured images attached to your posts, then you can still use this plugin just to show a default thumbnail on Facebook (as opposed to no thumbnail). This plugin has been engineered so that if you don't use a featured image on posts then a default thumbnail is used instead. You can set a <strong>Default Facebook Thumb</strong> in the Wordpress Settings -&gt; General page <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>.</p>
    <h3 id="topic04" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">What if some posts use featured images and some don't?</h3>
    <p>The <strong>Default Facebook Thumb</strong> is used  to fall back on in the event your post doesn't have a featured image. Ideally the <strong>Default Facebook Thumb</strong> image would be of your logo or brand. You can set a <strong>Default Facebook Thumb</strong> in the Wordpress Settings -&gt; General page <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>.</p>
    <p>When your post doesn't have a featured image, the meta property output in the &lt;head&gt; looks like something this:</p>
    <pre style='padding:5px;background:#f1f1f1;display:inline;'>&lt;meta property="og:image" content="<?php echo get_option('home'); ?>/wp-content/uploads/year/month/your-default-facebook-thumb.png" /&gt;</pre>
    <h3 id="topic05" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">Occasionally it doesn't work. What's going on?</h3>
    <p>Blame Facebook for that. Even though their system searches for the og:image meta property, for different reasons (outside the control of this plugin) sometimes  the thumbnail doesn't load on the Facebook post.</p>
    <p>You can fix it for yourself though using the official <a href='http://developers.facebook.com/tools/debug' target='_blank'>Facebook debugger</a> tool. Just go there, paste in the URL of your post, and see if the image thumb loads (scroll down to <strong>Object Properties</strong>). If it does, it should be good now.</p>
    <h3 id="topic06" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">Where can I get support and discuss this plugin?</h3>
    <p>The best place to discuss this plugin and reach out to me for support is at <a href="http://www.thatwebguyblog.com/post/facebook-thumb-fixer-for-wordpress/">the official page</a> on my blog.</p>
</div>

<?php }
add_action('wp_head', 'fbfixhead');
function fbfixhead() { 
if ( !is_home() ) { // If not the homepage
// If there is a post image...
if (has_post_thumbnail()) {
// Set '$featuredimg' variable for the featured image.
$featuredimg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");
$ftf_head = '
<!--/ Open Graph /-->
<meta property="og:image" content="' . $featuredimg[0] . '" />
<meta property="og:title" content="' . get_the_title() . '" /> 
<meta property="og:url" content="' . get_permalink() . '" /> 
';
//...otherwise, if there is no post image.
} else {
$ftf_head = '
<!--/ Open Graph /-->
<meta property="og:image" content="' . get_option('default_fb_thumb') . '" />
<meta property="og:title" content="' . get_the_title() . '" />
<meta property="og:url" content="' . get_permalink() . '" />
';
}
} else { //...otherwise, it must be the homepage so do this:
$ftf_head = '
<!--/ Open Graph /-->
<meta property="og:image" content="' . get_option('default_fb_thumb') . '" />
<meta property="og:title" content="' . get_bloginfo('name') . '" />
<meta property="og:url" content="' . get_option('home') . '" />
';
}
  echo $ftf_head;
  print "\n";
}