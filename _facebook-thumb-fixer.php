<?php
/*
Plugin Name: Facebook Thumb Fixer
Plugin URI: http://www.thatwebguyblog.com/post/facebook-thumb-fixer-for-wordpress/
Description: Fixes the problem of the missing (or wrong) thumbnail when a post is shared on Facebook.
Author: Michael Ott
Version: 1.3.1
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
		if ($fbt_value) {
        echo '<input type="text" id="default_fb_thumb" class="regular-text ltr" name="default_fb_thumb" value="' . $fbt_value . '" />';
		} else {
		echo '<input type="text" id="default_fb_thumb" class="regular-text ltr" name="default_fb_thumb" style="border:solid 1px #ff0000;" value="' . $fbt_value . '" />';
		}
		if ($fbt_value) {
		echo '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE4NDFDNDFEQzgwMjExRTI5MUZGQzg5MzA4ODM1MEFBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE4NDFDNDFFQzgwMjExRTI5MUZGQzg5MzA4ODM1MEFBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTg0MUM0MUJDODAyMTFFMjkxRkZDODkzMDg4MzUwQUEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTg0MUM0MUNDODAyMTFFMjkxRkZDODkzMDg4MzUwQUEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6VyfjPAAABLElEQVR42qyVMYrCQBSGx4dHELyB2O1W1mKTyhOIYGHl1p5hC2uxSbFNLrBWNsHaylJSbC94BvF/8mcZYoaZSfzhI4TJ+5KQNy+d1e+HcSQBYzACQ9AHV3ABJ3AEh7rCTo10AhZgBsS4cwcZ+AG5vVAtWoIdmHuEZe2c1y/thW5F+A16Ji4D1mlS+0n1ldcNhGV6rJ/Y0gXv2CYDep7ShB/lHVFPImwbiancTs9PHB9vLOzDKKEnI2FjBwns86/9p6tsKNwpTmH16BFq+sKt9xK7MEKouQr3svGJA4Wai3A4GJ84UKg5CafNPUQcEPUcheMre1Pzq+dQNr2Or6KlsKDnfyfpPNyAW0PhjfV5dfSlPK4jh0tBYVo3T0vxX9vJ3625OCdZ03/UQ4ABAPf1Uw2qATa2AAAAAElFTkSuQmCC" style="position:relative; top:6px; left:5px;" />';
		}
		echo '<p class="description">This is the full path to your default Facebook thumb (Ideally 200px x 200px. Go <a href="' . admin_url( '/options-general.php?page=facebook-thumb-fixer' ) . '">here</a> for more information.)</p>';
		if ($fbt_value) {
		echo '<p style="font-family:Georgia;font-style:italic;color:#666;">(Note: The image is shown scaled down here. The real dimensions are actually ';
		list($width, $height) = getimagesize($fbt_value); echo $width . ' x ' . $height . ')</p>';
		echo '<img src="' . $fbt_value . '" title="Default Facebook Thumb" style="max-width:75px;" />';
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
    <p style="background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABUAAAAVCAYAAACpF6WWAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjE4NDFDNDFEQzgwMjExRTI5MUZGQzg5MzA4ODM1MEFBIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjE4NDFDNDFFQzgwMjExRTI5MUZGQzg5MzA4ODM1MEFBIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6MTg0MUM0MUJDODAyMTFFMjkxRkZDODkzMDg4MzUwQUEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6MTg0MUM0MUNDODAyMTFFMjkxRkZDODkzMDg4MzUwQUEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6VyfjPAAABLElEQVR42qyVMYrCQBSGx4dHELyB2O1W1mKTyhOIYGHl1p5hC2uxSbFNLrBWNsHaylJSbC94BvF/8mcZYoaZSfzhI4TJ+5KQNy+d1e+HcSQBYzACQ9AHV3ABJ3AEh7rCTo10AhZgBsS4cwcZ+AG5vVAtWoIdmHuEZe2c1y/thW5F+A16Ji4D1mlS+0n1ldcNhGV6rJ/Y0gXv2CYDep7ShB/lHVFPImwbiancTs9PHB9vLOzDKKEnI2FjBwns86/9p6tsKNwpTmH16BFq+sKt9xK7MEKouQr3svGJA4Wai3A4GJ84UKg5CafNPUQcEPUcheMre1Pzq+dQNr2Or6KlsKDnfyfpPNyAW0PhjfV5dfSlPK4jh0tBYVo3T0vxX9vJ3625OCdZ03/UQ4ABAPf1Uw2qATa2AAAAAElFTkSuQmCC) no-repeat left; padding:0 0 0 20px; background-size:auto 90%;">Well done! You currently have a Default Facebook Thumbnail set. You can change it <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>.</p>
    <p style="font-family:Georgia, 'Times New Roman', Times, serif; font-style:italic;color:#666;">(Note: The image is shown scaled down here. The real dimensions are actually <?php list($width, $height) = getimagesize($fbt_value); echo $width . " x " . $height; ?>)</p>
    <img src="<?php echo $fbt_value; ?>" alt="" style="max-width:75px;" />
    <?php } else { ?>
    <p style="background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjdDNThGOTFENUQyRjExRTJCQjk2Q0JDQjdBODJBRkNGIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjdDNThGOTFFNUQyRjExRTJCQjk2Q0JDQjdBODJBRkNGIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6N0M1OEY5MUI1RDJGMTFFMkJCOTZDQkNCN0E4MkFGQ0YiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6N0M1OEY5MUM1RDJGMTFFMkJCOTZDQkNCN0E4MkFGQ0YiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6i+F3+AAAA70lEQVR42pxSMQ6DMAx0UVUWJCSmbh0RP4iYOsEn+AWvS6dOfAGY4AVMLHRxzxCFgKpKcPLgc86O7eTCzGTxepHWVFVU10KThNKU8pyybNXwgq7jsuQgQPbeEMQRBDPIqIvih9Q1COacOQEF/qsXg0wStN50EkV8vxsfDqjbm9ZXmXIczUBRJHMHAT2fQt9vOcLEwyAUviRgJxa3m6jjmPpeqO9T20rQAmIOw02jaGOazOrg2PYWC0OPdkA9W9L113dQalO+adgFqHuJUp68pcXnI5Oh78dDDA4oghYQH13riYc78zWOfL7L0e/9FWAAmacsvmIVFjAAAAAASUVORK5CYII=) no-repeat left; padding:0 0 0 20px; background-size:auto 90%;">You currently do not have a Default Facebook Thumbnail set. Set one <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>. Ideally this would be a 200px x 200px image of your logo or brand.</p>
    <?php } ?>
    <h3 style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">Help Topics</h3>
    <ul>
    	<li><a href="#topic01">What does this plugin do?</a></li>
        <li><a href="#topic02">How does it work?</a></li>
        <li><a href="#topic03">What if you don't use Featured Images on your pages or posts?</a></li>
        <li><a href="#topic04">Conflicts with other plugins</a></li>
        <li><a href="#topic05">What if some posts use featured images and some don't?</a></li>
        <li><a href="#topic06">Occasionally it doesn't work. What's going on?</a></li>
        <li><a href="#topic07">Where can I get support and discuss this plugin?</a></li>
    </ul>
    
    <h3 id="topic01" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">What does this plugin do?</h3>
    <p>This plugin will place the appropriate  <a href="http://ogp.me/" target="_blank">Open Graph</a> meta properties into the &lt;head&gt; of your web pages, so that when someone links to your page on Facebook (or any other service that utilises the Open Graph protocol) the correct thumbnail and other information will show.</p>
    <p>This includes:</p>
    <p><strong>og:title</strong><br />
    The open graph title is automatically determined by the page or post title.</p>
    <p><strong>og:type</strong><br />
    The open graph type 
    is automatically determined by detecting if the current page is an article or the home page (website).</p>
    <p><strong>og:url</strong><br />
    The open graph URL is automatically determined by the permalink for the current web page.</p>
    <p><strong>og:description</strong><br />
    The open graph description is automatically determined by the post/page excerpt for internal pages, and the website tagline when on the homepage. Be sure to add a suitable website description into the tagline field <a href="options-general.php">here</a>, and excerpts to your pages and posts.</p>
    <p><strong>og:site_name</strong><br />
    The open graph site name 
    is automatically determined by the site title. Be sure to add a suitable  title into the Site Title field <a href="options-general.php">here</a>.</p>
    <p><strong>og:image</strong><br />
    The thumbnail is derived from the featured image of your post (or page). For example:</p>
    <p><img src="<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/sample-post.png" alt="" /></p>
    <p>If your post does not have a featured image, then the default thumbnail will take over. For example:</p>
    <p><img src="<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/sample-post-default.png" alt="" /></p>
    <p>If someone links to your home page (which traditionally doesn't have a featured image) then the default image is also used here.</p>
    <img src="<?php echo get_option('home'); ?>/wp-content/plugins/facebook-thumb-fixer/images/sample-home.png" alt="" /></p>
    
    <h3 id="topic02" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">How does it work?</h3>
    <p>Whenever anyone posts a website link to Facebook, the Facebook system searches the source code for the <a href="https://developers.facebook.com/docs/concepts/opengraph/" target="_blank">Open Graph</a>  meta properties. If they are not found, then it will instead pull (several) images (if any) contained within the web page. If there are multiple images pulled then the user can select one of the many presented (though the one they choose might not be the one you are happy to have as the primary image shown on Facebook, hence this plugin).</p>
    <p>This plugin gets around that problem but taking  that choice away from the Facebook user, so only the thumbnail you want is displayed. This is also good in a situation where - for example - many different Facebook users share your web page,  you can trust the same thumbnail will always be used (the thumbnail might be of your brand for example).</p>
    <p>This plugin inserts the og:image meta property into the &lt;head&gt; of your website and pulls the featured image for any post. For those interested, the code output looks like something this:</p>
    <pre style='padding:5px;background:#f1f1f1;display:inline;'>&lt;meta property="og:image" content="<?php echo get_option('home'); ?>/wp-content/uploads/year/month/featured-image-name.png" /&gt;</pre>
    <p>This will be the image that is used when anyone adds a link to your post on Facebook.</p>
    
    <h3 id="topic03" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">What if you don't use Featured Images on your pages or posts?</h3>
    <p>If you don't have featured images attached to your posts, then you can still use this plugin just to show a default thumbnail on Facebook (as opposed to no thumbnail). This plugin has been engineered so that if you don't use a featured image on posts then a default thumbnail is used instead. You can set a <strong>Default Facebook Thumb</strong> in the Wordpress Settings -&gt; General page <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>.</p>
    
    <h3 id="topic04" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">Conflicts with other plugins</h3>
    <p>Any other plugin that inserts the open graph properties into the &lt;head&gt; of your website may cause a conflict and failure to work properly.</p>
    <p>To test if you have a conflict, simply view the source code of your home page and search for any instances of <strong>og:</strong> within. Typically a plugin will output the meta tags into it's own group. For this plugin, they will be directly below the comment &lt;!--/ Open Graph /--&gt; but other plugins will output differently.</p>
    <p>The only solution to resolve a conflict is to disable one of the plugins.</p>
    
    <h3 id="topic05" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">What if some posts or pages use featured images and some don't?</h3>
    <p>The <strong>Default Facebook Thumb</strong> is used  to fall back on in the event your post doesn't have a featured image. Ideally the <strong>Default Facebook Thumb</strong> image would be of your logo or brand. You can set a <strong>Default Facebook Thumb</strong> in the Wordpress Settings -&gt; General page <a href="<?php echo get_admin_url(); ?>/options-general.php">here</a>.</p>
    <p>When your post or page doesn't have a featured image, the meta property output in the &lt;head&gt; looks like  this:</p>
    <pre style='padding:5px;background:#f1f1f1;display:inline;'>&lt;meta property="og:image" content="<?php echo get_option('home'); ?>/wp-content/uploads/year/month/your-default-facebook-thumb.png" /&gt;</pre>
    
    <h3 id="topic06" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">Occasionally it doesn't work. What's going on?</h3>
    <p>Blame Facebook for that. Even though their system searches for the og:image meta property, for different reasons (outside the control of this plugin) sometimes  the thumbnail doesn't load on the Facebook post.</p>
    <p>You can fix it for yourself though using the official <a href='http://developers.facebook.com/tools/debug' target='_blank'>Facebook debugger</a> tool. Just go there, paste in the URL of your post, and see if the image thumb loads (scroll down to <strong>Object Properties</strong>). If it does, it should be good now.</p>
    
    <h3 id="topic07" style="border-top:solid 1px #ccc; margin:20px 0; padding:20px 0 0 0;">Where can I get support and discuss this plugin?</h3>
    <p>The best place to discuss this plugin and reach out to me for support is at <a href="http://www.thatwebguyblog.com/post/facebook-thumb-fixer-for-wordpress/" target="_blank">this page</a> on my blog.</p>
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
<meta property="og:title" content="' . get_the_title() . '" />
<meta property="og:type" content="article" />
<meta property="og:url" content="' . get_permalink() . '" /> 
<meta property="og:description" content="' . get_the_excerpt() . '" />
<meta property="og:site_name" content="' . get_bloginfo('name') . '" />
<meta property="og:image" content="' . $featuredimg[0] . '" />
';
//...otherwise, if there is no post image.
} else {
$ftf_head = '
<!--/ Open Graph /-->
<meta property="og:title" content="' . get_the_title() . '" />
<meta property="og:type" content="article" />
<meta property="og:url" content="' . get_permalink() . '" />
<meta property="og:description" content="' . get_the_excerpt() . '" />
<meta property="og:site_name" content="' . get_bloginfo('name') . '" />
<meta property="og:image" content="' . get_option('default_fb_thumb') . '" />
';
}
} else { //...otherwise, it must be the homepage so do this:
$ftf_head = '
<!--/ Open Graph /-->
<meta property="og:title" content="' . get_bloginfo('name') . '" />
<meta property="og:type" content="website" />
<meta property="og:url" content="' . get_option('home') . '" />
<meta property="og:description" content="' . get_bloginfo (strip_tags('description')) . '" />
<meta property="og:site_name" content="' . get_bloginfo('name') . '" />
<meta property="og:image" content="' . get_option('default_fb_thumb') . '" />
';
}
  echo $ftf_head;
  print "\n";
}