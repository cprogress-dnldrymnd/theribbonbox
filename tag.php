<?php
/*
Template Name: Archives
*/
get_header(); ?>

<?php if ( have_posts() ) : ?>
    <header class="page-header">
      <?php
      the_archive_title( '<h1 class="page-title">', '</h1>' );
      the_archive_description( '<div class="taxonomy-description">', '</div>' );
      ?>
    </header><!-- .page-header -->
<?php endif; ?>

    <div id="primary" class="content-area max-width">
        <main id="main" class="site-main">

          <?php
          global $query_string;
          query_posts($query_string . "&posts_per_page=50");
          ?>

          <?php
          if ( have_posts() ) : ?>
              <div class="posts cols-3">
                <?php while ( have_posts() ) :
                  the_post();

                  /*
                   * Include the Post-Format-specific template for the content.
                   * If you want to override this in a child theme, then include a file
                   * called content-___.php (where ___ is the Post Format name) and that
                   * will be used instead.
                   */
                  //get_template_part( 'template-parts/post/content', get_post_format() ); /* e.g. 'excerpt' */
                  get_template_part( 'template-parts/post/content', get_post_type() ); /* e.g. 'post' */

                endwhile; ?>
              </div>
            <?php
                the_posts_pagination();
                //posts_nav_link();
          else :
            get_template_part( 'template-parts/post/content', 'none' );
          endif;
          ?>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();