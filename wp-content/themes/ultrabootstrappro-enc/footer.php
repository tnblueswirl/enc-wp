<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ultrabootstrap
 */

?>
		<!-- Tab to top scrolling -->
		<div class="scroll-top-wrapper"> <span class="scroll-top-inner">
  			<i class="fa fa-2x fa-angle-up"></i>
    		</span>
    	</div> 
		<footers>
		<div class="container footers">
        <div class="row">
            <?php dynamic_sidebar( 'footer-1' ); ?>
            <?php dynamic_sidebar( 'footer-2' ); ?>
            <?php dynamic_sidebar( 'footer-3' ); ?>
            <?php dynamic_sidebar( 'footer-4' ); ?>
        </div>
    	</div>
		</footers>
		<footer>
		<div class="container">
			<div class="footer-menu">
				<?php wp_nav_menu('footer'); ?>
			</div>
		</div>
		<div class="container">

				<?php 
                    $show_social_in_footer = get_theme_mod('socialicon_display' );
                    {?>   
			        <div class="pull-left">
				            <ul class="list-inline social">
	                            <?php 
	                            $facebook =  esc_url(get_theme_mod('facebook_textbox'));
	                            $twitter = esc_url(get_theme_mod('twitter_textbox'));
	                            $googleplus = esc_url(get_theme_mod('googleplus_textbox'));
	                            $youtube = esc_url(get_theme_mod('youtube_textbox'));
	                            $linkedin = esc_url(get_theme_mod('linkedin_textbox'));
	                            $pinterest = esc_url(get_theme_mod('pinterest_textbox'));
	                            $tumblr = esc_url(get_theme_mod('tumblr_textbox'));
	                            $flickr = esc_url(get_theme_mod('flickr_textbox'));
	                            $instagram = esc_url(get_theme_mod('instagram_textbox'));
	                          	if($facebook){?>
	                              <li><a href="<?php echo $facebook;?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
	                            <?php }
	                            if($twitter){?>
	                              <li><a href="<?php echo $twitter;?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
	                            <?php }
	                            if($pinterest){?>
	                              <li><a href="<?php echo $pinterest;?>" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>
	                            <?php }
	                            if($instagram){?>
	                              <li><a href="<?php echo $instagram;?>" title="Instagram"><i class="fa fa-instagram"></i></a></li>
	                            <?php }
	                            if($youtube){?>
	                              <li><a href="<?php echo $youtube;?>" title="YouTube"><i class="fa fa-youtube-play"></i></a></li>
	                            <?php }
	                            if($tumblr){?>
                            	  <li><a href="<?php echo $tumblr;?>" title="Tumblr"><i class="fa fa-tumblr"></i></a></li>
                            	<?php }
                            	if($flickr){?>
                        		  <li><a href="<?php echo $flickr;?>" title="Flickr"><i class="fa fa-flickr"></i></a></li>
                            	<?php }
	                            if($googleplus) {?>
	                              <li><a href="<?php echo $googleplus;?>" title="Google+"><i class="fa fa-google-plus"></i></a></li>
	                            <?php }
	                            if($linkedin){?>
	                              <li><a href="<?php echo $linkedin;?>" title="LinkedIn"><i class="fa fa-linkedin"></i></a></li>
	                            <?php } ?>

                        	</ul>
					</div>
				<?php }?> 
				<?php $copyright=  esc_attr(get_theme_mod ('copyright_textbox')); 
				 if ($copyright) {?> 
				 <?php } ?>
			    <div class="pull-right">
			    <?php $copyright=  esc_attr(get_theme_mod ('copyright_textbox')); 
				 if ($copyright) {
				 			echo $copyright; 
				 	} 
				 	else { ?>
			        <?php echo __('Theme Ultrabootstrap by','ultrabootstrap'); ?> <a href="http://phantomthemes.com"><?php echo __('Phantom Themes','ultrabootstrap'); ?></a>
			        <?php } ?>
			      </div>
			    </div>

		</footer>

	
		
		<?php wp_footer(); ?>
		<?php get_template_part('inc/custom-css'); ?>
	</body>
</html>