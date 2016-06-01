<?php 
/*
Template Name: Testimonial List
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
wp_enqueue_script('gt3_endlessScroll_js', get_template_directory_uri() . '/js/jquery.endless-scroll.js', array(), false, true);
wp_enqueue_script('gt3_masonry_js', get_template_directory_uri() . '/js/masonry.min.js', array(), false, true);

if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') {
	wp_enqueue_script('gt3_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, true);
	wp_enqueue_script('gt3_isotope_sorting', get_template_directory_uri() . '/js/sorting.js', array(), false, true);
}
?>
    <div class="fullscreen_block hided">
		<?php 
			global $wp_query_in_shortcodes, $paged;
			
			$wp_query_in_shortcodes = new WP_Query();
            $args = array(
                'post_type' => 'testimonials',
                'order' => 'DESC',
                'posts_per_page' => -1
            );

            if (isset($_GET['slug']) && strlen($_GET['slug']) > 0) {
                $post_type_terms = $_GET['slug'];
				$selected_categories = $_GET['slug'];
            }
					
		?>
	    <div class="fs_blog_module is_masonry">
		<?php 
	        $wp_query_in_shortcodes->query($args);			
	        while ($wp_query_in_shortcodes->have_posts()) : $wp_query_in_shortcodes->the_post();
				$all_likes = gt3pb_get_option("likes");
				$gt3_theme_post = get_plugin_pagebuilder(get_the_ID());
				$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
				$pf = get_post_format();
                $target = (isset($gt3_theme_post['settings']['new_window']) && $gt3_theme_post['settings']['new_window'] == "on" ? "target='_blank'" : "");
				$linkToTheWork = get_permalink();
				$echoallterm = '';
				$new_term_list = get_the_terms(get_the_id(), "portcat");
                if (is_array($new_term_list)) {
                    foreach ($new_term_list as $term) {
                        $tempname = strtr($term->name, array(
                            ' ' => '-',
							'&amp;' => '_',
							'&' => '_'
                        ));
                        $echoallterm .= strtolower($tempname) . " ";
                        $echoterm = $term->name;
                    }
                } else {
                    $tempname = __('Uncategorized', 'theme_localization');
                }							
			?>
            <?php if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') { ?>
				<div <?php post_class("blogpost_preview_fw element ". $echoallterm); ?> data-category="<?php echo $echoallterm ?>">
            <?php } else { ?>
				<div <?php post_class("blogpost_preview_fw "); ?>>
			<?php } ?>
					<div class="fw_preview_wrapper">
                    	<div class="gallery_item_wrapper">
                            <a href="<?php echo $linkToTheWork; ?>" <?php echo $target; ?>>
                                <img src="<?php echo aq_resize($featured_image[0], "540", "", true, true, true); ?>" alt="" class="fw_featured_image" width="540">
                                <div class="gallery_fadder"></div>
                                <span class="gallery_ico"><i class="stand_icon icon-eye"></i></span>
                            </a>
                        </div>
                        <div class="grid-port-cont">
                            <h6><a href="<?php echo $linkToTheWork; ?>" <?php echo $target; ?>><?php the_title(); ?></a></h6>
                            <div class="block_likes">
								<div class="post-views"><i class="stand_icon icon-eye"></i> <span><?php echo (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0"); ?></span></div>                            
                                <div class="gallery_likes gallery_likes_add <?php echo (isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="like_port">
                                    <i class="stand_icon <?php echo (isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
                                    <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
                                </div>											
                            </div>                            
                        </div>                                            
                    </div>
                </div>      
			<?php endwhile; wp_reset_query();?>
        </div>
		<?php if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') { ?>
            <a href="<?php echo esc_js("javascript:void(0)");?>" class="load_more_works"><i class="icon-arrow-down"></i><?php _e('Load more works', 'theme_localization') ?></a>
            
        <?php }?>        
	</div>
   	<div class="preloader"></div>
    <script>

        var posts_already_showed = <?php gt3_the_theme_option('fw_port_per_page'); ?>;

	<?php if (isset($gt3_theme_pagebuilder['portfolio']['port_type']) && $gt3_theme_pagebuilder['portfolio']['port_type'] == 'port_isotope') {?>
	<?php } else { ?>

        jQuery(window).load(function () {
			jQuery('.is_masonry').masonry();
			setTimeout("jQuery('.is_masonry').masonry();",1000);
        });
        jQuery(window).resize(function () {
			jQuery('.is_masonry').masonry();
        });
		jQuery(document).ready(function($){
            jQuery('.is_masonry').masonry();
		});		
	<?php } ?>

		jQuery(document).ready(function($){

            jQuery('.gallery_likes_add').click(function(){
				var gallery_likes_this = jQuery(this);
				if (!jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'))) {
					jQuery.post(gt3_ajaxurl, {
						action:'add_like_attachment',
						attach_id:jQuery(this).attr('data-attachid')
					}, function (response) {
						jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'), 'true', { expires: 7, path: '/' });
						gallery_likes_this.addClass('already_liked');
						gallery_likes_this.find('i').removeClass('icon-heart-o').addClass('icon-heart');
						gallery_likes_this.find('span').text(response);
					});
				}
            });
			
			setTimeout(function(){
                jQuery('.fullscreen_block').removeClass('hided');
			},2500);
			setTimeout("jQuery('.preloader').remove()",2700);			
		});	
    </script>    
	<?php 
    //$gt3_pagination = gt3_get_theme_pagination(gt3_get_theme_option('fw_posts_per_page'), $type = "show_in_shortcodes");
	//echo $gt3_pagination;	
	?>
    
<?php get_footer('fullwidth'); 
} else {
	get_header('fullscreen');
	echo "<div class='fixed_bg' style='background-image:url(".gt3_get_theme_option('bg_img').")'></div>";
?>
    <div class="pp_block">
        <div class="container">
        	<h1 class="pp_title"><?php  _e('THIS CONTENT IS PASSWORD PROTECTED', 'theme_localization') ?></h1>
            <div class="pp_wrapper">
				<?php the_content(); ?>
            </div>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
			jQuery('html').addClass('without_border');
		});
	</script>
<?php 
	get_footer('fullscreen');
} ?>