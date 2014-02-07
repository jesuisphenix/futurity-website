  
<?php get_header(); global $post;
$args = get_posts(array(
	'post_type' => array('post', 'page'),
	'orderby' => 'date',
	'meta_query' => array(
		array(
			'key' => 'main',
			'value' => '1',
			'compare' => '=='
		)
			
	)
));
foreach ($args as $post) :setup_postdata($post); 

 $the_query = new WP_Query( $args );
?>
  <section>    
<article id="about"><h2><?php the_title(); ?></h2></article>
	<p>
             <?php  the_content(); ?>
         </p></section>

<?php
endforeach; 
?> 

 <?php get_footer(); ?>
