<?php get_header(); ?>
<body>
	<article id="about"><h2><?php the_title(); ?></h2></article>
	<p> <?php if ( $wp_query->have_posts() ) :
            while ( $wp_query->have_posts() ) : $wp_query->the_post(); the_content(); endwhile; endif; ?></p>
<?php get_footer(); ?>
