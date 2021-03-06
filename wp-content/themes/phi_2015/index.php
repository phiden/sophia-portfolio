<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file 
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div class='homepage'>

	<!-- The Query -->
	<?php $main_query = new WP_Query( array( 'category_name' => 'home', 'order' => 'ASC') ); ?>
	
	<?php 
		
		//$main_query = new WP_Query( array('category_name' => 'design', 'posts_per_page' => 4 ));
		
		// The Loop
		if ( $main_query->have_posts() ) { ?>
		
			<?php while ( $main_query->have_posts() ) { ?>
				
				<?php $main_query->the_post(); ?>
				
				<article class='row twelve columns'>
				
					<h2 id="<?php echo get_post_meta(get_the_ID(), 'link', true) ?>"><?php the_title(); ?></h2>
					
					<?php if (get_post_meta(get_the_ID(), 'link', true) == 'designer') { ?>

            <?php $the_query = new WP_Query( array('category_name' => 'design', 'posts_per_page' => 4 )); ?>
           
            	<?php if ( $the_query->have_posts() ) { ?>
	            <?php while ( $the_query->have_posts() ) { ?>
	                
	              <?php $the_query->the_post(); ?>
	              
	              <div class='three columns'>
	              	
	              	<h4><?php the_title(); ?></h4>
	              	<div class='homepage-image'><?php the_post_thumbnail(); ?></div>
	              
	              </div>
              
              <?php } ?> <!-- close while -->
                
          <?php } ?> <!-- close if query has posts -->
            
        <?php } else if(get_post_meta(get_the_ID(), 'link', true) == 'maker') { ?>

            this is where maker stuff goes.
            <?php $the_query = new WP_Query( array('category_name' => 'maker', 'posts_per_page' => 4 )); ?>
           
            <?php if ( $the_query->have_posts() ) { ?>
	            <?php while ( $the_query->have_posts() ) { ?>
	                
	              <?php $the_query->the_post(); ?>
	              
	              <div class='three columns'>
	              	
	              	<?php the_title(); ?>
	              
	              </div>
              
              <?php } ?> <!-- close while -->
                
          <?php } ?> <!-- close if query has posts -->


        <?php } else { ?>

            <?php the_content(); ?>

        <?php } ?>
				
				</article>
				
			<?php } ?> <!-- close endwhile -->
			
		<?php } ?>
		
		
		
</div>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer') ); ?>