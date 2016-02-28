		</div>
	</div>
	<?php global $smof_data, $social_icons; ?>
	<?php
	$object_id = get_queried_object_id();
	if((get_option('show_on_front') && get_option('page_for_posts') && is_home()) ||
		(get_option('page_for_posts') && is_archive() && !is_post_type_archive()) && !(is_tax('product_cat') || is_tax('product_tag')) || (get_option('page_for_posts') && is_search())) {
		$c_pageID = get_option('page_for_posts');
	} else {
		if(isset($object_id)) {
			$c_pageID = $object_id;
		}

		if(class_exists('Woocommerce')) {
			if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
				$c_pageID = get_option('woocommerce_shop_page_id');
			}
		}
	}
	?>
	<?php if(!is_page_template('blank.php')): ?>
	<?php if( ($smof_data['footer_widgets'] && get_post_meta($c_pageID, 'pyre_display_footer', true) != 'no') ||
			  ( ! $smof_data['footer_widgets'] && get_post_meta($c_pageID, 'pyre_display_footer', true) == 'yes') ): ?>
	<footer class="footer-area">
		<div class="avada-row">
			<div class="fusion-columns row fusion-columns-<?php echo $smof_data['footer_widgets_columns']; ?> columns columns-<?php echo $smof_data['footer_widgets_columns']; ?>">
				<?php 
				$column_width = 12 / $smof_data['footer_widgets_columns']; 
				if( $smof_data['footer_widgets_columns'] == '5' ) {
					$column_width = 2;
				}
				?>
			
				<?php if( $smof_data['footer_widgets_columns'] >= 1 ): ?>
				<div class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?> ">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 1')):
				endif;
				?>
				</div>
				<?php endif; ?>
				
				<?php if( $smof_data['footer_widgets_columns'] >= 2 ): ?>
				<div class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 2')):
				endif;
				?>
				</div>
				<?php endif; ?>
				
				<?php if( $smof_data['footer_widgets_columns'] >= 3 ): ?>
				<div class="fusion-column col <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 3')):
				endif;
				?>
				</div>
				<?php endif; ?>
				
				<?php if( $smof_data['footer_widgets_columns'] >= 4 ): ?>
				<div class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 4')):
				endif;
				?>
				</div>
				<?php endif; ?>

				<?php if( $smof_data['footer_widgets_columns'] >= 5 ): ?>
				<div class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 5')):
				endif;
				?>
				</div>
				<?php endif; ?>

				<?php if( $smof_data['footer_widgets_columns'] >= 6 ): ?>
				<div class="fusion-column col last <?php echo sprintf( 'col-lg-%s col-md-%s col-sm-%s', $column_width, $column_width, $column_width ); ?>">
				<?php
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widget 6')):
				endif;
				?>
				</div>
				<?php endif; ?>
				<div class="fusion-clearfix"></div>
			</div>
		</div>
	</footer>
	<?php endif; ?>
	<?php if( ($smof_data['footer_copyright'] && get_post_meta($c_pageID, 'pyre_display_copyright', true) != 'no') ||
			  ( ! $smof_data['footer_copyright'] && get_post_meta($c_pageID, 'pyre_display_copyright', true) == 'yes') ): ?>
	<footer id="footer">
		<div class="avada-row">
			<div class="copyright-area-content">
				<div class="copyright">
					<div><?php echo do_shortcode( $smof_data['footer_text'] ); ?></div>
				</div>
				<?php if($smof_data['icons_footer']) : ?>				
				<div class="fusion-social-links-footer">
					<?php 
					$footer_soical_icon_options = array (
						'position'			=> 'footer',
						'icon_colors' 		=> $smof_data['footer_social_links_icon_color'],
						'box_colors' 		=> $smof_data['footer_social_links_box_color'],
						'icon_boxed' 		=> $smof_data['footer_social_links_boxed'],
						'icon_boxed_radius' => $smof_data['footer_social_links_boxed_radius'],
						'tooltip_placement'	=> $smof_data['footer_social_links_tooltip_placement'],
						'linktarget'		=> $smof_data['social_icons_new']
					);

					
					echo $social_icons->render_social_icons($footer_soical_icon_options); ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</footer>
	<?php endif; ?>
	<?php endif; ?>
	</div><!-- wrapper -->
	
	<?php if( ( ( $smof_data['layout'] == 'Boxed' && get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) == 'default' ) || get_post_meta( $c_pageID, 'pyre_page_bg_layout', true ) == 'boxed' ) && $smof_data['header_position'] != 'Top' ): ?>
	</div>
	<?php endif; ?>	

	<?php //include_once('style_selector.php'); ?>
	
	<!-- W3TC-include-js-head -->

	<?php wp_footer(); ?>

	<?php echo $smof_data['space_body']; ?>

	<!--[if lte IE 8]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
	<![endif]-->
    
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("ul#mobile-nav").prepend('<li><a class="button small green mobile_blue_btn" data-target="#free-estimate_111" data-toggle="modal" target="_self" href="javascript:void(0)">GET STARTED</a></li>');
    });
</script> 

<div class="modal fade" id="free-estimate_111" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color:#f6f6f6;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size:30px;">x</button>
        <!--h4 class="modal-title" id="myModalLabel">Modal title</h4-->
      </div>
      <div class="modal-body">
      	<h2 style="text-align: center; font-size: 28px !important; text-transform: uppercase;">FREE Web Consultation</h2>
      	<div class="tx-div2 small"></div>
		<?php echo do_shortcode( '[gravityform id="9" name="Mobile Header Pop up" title="false" description="false" ajax="true"]' ); ?>
      </div>
    </div>
  </div>
</div>   
<!--<script type="text/javascript">
    $(document).ready(function() {
        alert("I am an alert box!");
    });
</script>-->
   <!-- <script type="text/javascript">
    jQuery(document).ready(function() {
        //alert("I am an alert box!");
		jQuery(".toggle-alert").click( function () {
		   jQuery(".modal-header .close").trigger('click');
		});
    });
</script>-->



<!-- TrenDemon Code -->
<script type="text/javascript" id="trd-flame-load">(function(d, s, id) {
    var js, trdjs = d.getElementsByTagName(s)[0];
    var trddomain = "https://prod.trendemon.com/apis/loadflame/mainflamejs";
    var trdparams  = "aid=1367&uid=1381&baseurl=https%3A%2F%2Fprod.trendemon.com%2F&appid=208770359181748";
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.async=true;
    js.src = trddomain+'?'+trdparams;
    trdjs.parentNode.insertBefore(js, trdjs);
}(document, 'script', 'trdflame'));
</script>
<!-- End of TrenDemon Code -->


<!-- Google Code for Remarketing Tag -->
<!--------------------------------------------------
Remarketing tags may not be associated with personally identifiable information or placed on pages related to sensitive categories. See more information and instructions on how to setup the tag on: http://google.com/ads/remarketingsetup
--------------------------------------------------->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1036233801;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1036233801/?value=0&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
<!-- End of Google Code for Remarketing Tag -->






</body>
</html>