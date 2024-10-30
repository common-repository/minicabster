<?php
/*
Plugin Name: Minicabster Plugin 
Description: Use Minicabster plugin for searching minicabs in the UK. You can earn money by recommending us to your customers through your website
Version: 1.0
Author: https://minicabster.co.uk
Author URI: https://minicabster.co.uk
*/
class Minicabster extends WP_Widget {

  public static $opts=array();
  function minicabster() {
    parent::WP_Widget(false, $name = __('Minicabster', 'Minicabster') );
  }
  function form($instance) {
    if( $instance) {
      $affid = esc_attr($instance['affid']);
	  $token = esc_attr($instance['token']);
	  $width = esc_attr($instance['width']);
	  $height = esc_attr($instance['height']);
	  $cabid = esc_attr($instance['cabid']);
	} else {
	  $affid = '';
	  $token = '';
	  $width = '';
	  $height = '';
	  $cabid = '';
	}
?>
	<script>
		function whereisaffid(url, w, h){
			window.open(url, "", "width="+w+", height="+h);
		}
	</script>
    <p>
    	If you don't have the <b>token or ID</b>, <a href="https://minicabster.co.uk/affiliate.php" target="_blank">click here to register</a><br/><br/>
    	<b>NOTE: </b>You only need one identifier (Affiliate ID or Affiliate Token). If you do not specify either one, Minicabster cannot log the bookings from your site and therefore will not receive up to 5% of the amount paid for each journey.<br/><br/>
    	<label for="<?php echo $this->get_field_id('affid'); ?>"><?php _e('Minicabster Affiliate ID: ', 'Minicabster'); ?></label>
    	<input id="<?php echo $this->get_field_id('affid'); ?>" name="<?php echo $this->get_field_name('affid'); ?>" type="text" value="<?php echo $affid; ?>" />
    	<br/><a href="javascript:void(0)" onclick="whereisaffid('<?php echo plugins_url(); ?>/minicabster/js/aff_id.png','1068','100')">Where is my Affiliate ID?</a>
    </p>
    <p><b>OR</b><br/><br/><label for="<?php echo $this->get_field_id('token'); ?>"><?php _e('Minicabster Affiliate Token: ', 'Minicabster'); ?></label><input id="<?php echo $this->get_field_id('token'); ?>" name="<?php echo $this->get_field_name('token'); ?>" type="text" value="<?php echo $token; ?>" />
    	<br/><a href="javascript:void(0)" onclick="whereisaffid('<?php echo plugins_url(); ?>/minicabster/js/token.png','1101','400')">Where is my Affiliate Token?</a>
    </p>
    <p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Minicabster Widget Width (Recommended: 293):', 'Minicabster'); ?></label><input id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Minicabster Widget Height (Recommended: 580):', 'Minicabster'); ?></label><input id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" /></p>
    <p><label for="<?php echo $this->get_field_id('cabid'); ?>"><?php _e('Minicabster Cab ID (OPTIONAL. Only specific cab will be quoted):', 'Minicabster'); ?></label><input id="<?php echo $this->get_field_id('cabid'); ?>" name="<?php echo $this->get_field_name('cabid'); ?>" type="text" value="<?php echo $cabid; ?>" /></p>
<?php
  }
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['affid'] = strip_tags($new_instance['affid']);
    $instance['token'] = strip_tags($new_instance['token']);
    $instance['width'] = strip_tags($new_instance['width']);
    $instance['height'] = strip_tags($new_instance['height']);
    $instance['cabid'] = strip_tags($new_instance['cabid']);
    return $instance;
  }
  function widget($args, $instance) {
    extract( $args );
    $affid = $instance['affid'];
	$token = $instance['token'];
	$width = $instance['width'];
	$height = $instance['height'];
	$cabid = $instance['cabid'];
	echo $before_widget;
	echo '<div class="widget-text minicabster_widget_plugin_box" id="minicabster_widget_plugin_box"></div>';
	if( $affid ) {
	  self::$opts['affid'] = $affid;
	}
	if( $token ) {
	  self::$opts['token'] = $token;
	}
	if( $width ) {
	  self::$opts['width'] = $width;
	}
	if( $height ) {
	  self::$opts['height'] = $height;
	}
	if( $cabid ) {
	  self::$opts['cabid'] = $cabid;
	}
	self::$opts['pl'] = "wps";
	echo $after_widget;

	wp_register_script( 'minicabster_in', plugins_url('/js/in.js', __FILE__), false, '1.1',true );
	wp_localize_script( 'minicabster_in', 'minicabster', self::$opts);
	wp_enqueue_script( 'minicabster_in' );
  }
}
add_action('widgets_init', create_function('', 'return register_widget("minicabster");'));
?>