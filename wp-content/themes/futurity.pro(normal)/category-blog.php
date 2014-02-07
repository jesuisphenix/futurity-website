<?php get_header(); ?>
<body><?php if ( $wp_query->have_posts() ) : 
while ( $wp_query->have_posts() ) : ?>
	 
            <?php $wp_query->the_post(); ?>
<article id="about"><h2><?php the_title(); ?></h2></article>
	<p>
             <?php  the_content(); endwhile; endif; ?></p>
<?php get_footer(); ?>
