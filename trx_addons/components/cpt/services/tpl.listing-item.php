<?php
/**
 * The style "iconed" of the Services item
 *
 * @package WordPress
 * @subpackage ThemeREX Addons
 * @since v1.4
 */

$args = get_query_var('trx_addons_args_sc_services');
$number = get_query_var('trx_addons_args_item_number');

$meta = get_post_meta(get_the_ID(), 'trx_addons_options', true);
$link = get_permalink();
if (empty($args['id'])) $args['id'] = 'sc_services_'.str_replace('.', '', mt_rand());
if (empty($args['featured'])) $args['featured'] = 'icon';
if (empty($args['featured_position'])) $args['featured_position'] = 'top';
$svg_present = false;
$image = '';
if ( has_post_thumbnail() ) {
	$image = trx_addons_get_attachment_url( get_post_thumbnail_id( get_the_ID() ), trx_addons_get_thumb_size('masonry') );
}

if (!empty($args['slider'])) {
	?><div class="slider-slide swiper-slide"><?php
} else if ($args['columns'] > 1) {
	?><div class="<?php echo esc_attr(trx_addons_get_column_class(1, $args['columns'])); ?> "><?php
}
?>
<div class="sc_services_item<?php
	echo isset($args['hide_excerpt']) && $args['hide_excerpt'] ? ' without_content' : ' with_content';
	echo !empty($image) ? ' with_image' : '';
	echo 'icon' == $args['featured'] ? ' with_icon' : '';
	echo 'number' == $args['featured'] ? ' with_number' : '';
	echo ' sc_services_item_featured_'.esc_attr($args['featured_position']);
?>"<?php
	if (!empty($args['popup'])) {
		?> data-post_id="<?php echo esc_attr(get_the_ID()); ?>"<?php
		?> data-post_type="<?php echo esc_attr(TRX_ADDONS_CPT_SERVICES_PT); ?>"<?php
	}
?>>
	<div class="sc_services_item_content">
		<div class="sc_services_icon_title">
			<a href="<?php echo esc_url($link); ?>" class="icon-arrow_left"></a>
		</div><div class="sc_services_item_title_content">
			<h6 class="sc_services_item_title">
			<a href="<?php echo esc_url($link); ?>"><?php
			the_title();
		?></a></h6>
		</div>
	</div>
</div>
<?php
if (!empty($args['slider']) || $args['columns'] > 1) {
	?></div><?php
}
if (trx_addons_is_on(trx_addons_get_option('debug_mode')) && $svg_present) {
	wp_enqueue_script( 'vivus', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'icons/vivus.js'), array('jquery'), null, true );
	wp_enqueue_script( 'trx-addons-sc-icons', trx_addons_get_file_url(TRX_ADDONS_PLUGIN_SHORTCODES . 'icons/icons.js'), array('jquery'), null, true );
}
?>