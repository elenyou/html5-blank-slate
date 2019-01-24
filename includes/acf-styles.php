<?php
/**
 * Styles that rely on values from ACF are generated here
 * Non-ACF styling is contained within /src/scss/layouts/
 *
 *
 * Each time submitted $_POST data is saved,
 * such as pressing "Update" on the WP Admin page/post editor pages,
 * the "generate_acf_css" function within functions.php
 * will use this file to create/update the acf-styles.css file and enqueue it
 * https://www.advancedcustomfields.com/resources/acf-save_post/
 */
 ?>


<?php
/**
 * $count keeps track of each layout instance,
 * so that there can be more than one of each layout type,
 * each with different settings/values/content
 */
 ?>
<?php if ( have_rows( 'flex' ) ): $count = 1; ?>
<?php while ( have_rows( 'flex' ) ): the_row(); ?>

<?php //****************  Banner section ****************/ ?>
  <?php if ( get_row_layout() == 'banner' ): ?>

    <?php if(get_sub_field('bg_image')) : ?>
      .banner<?= $count; ?>:before {
        background-image: url('<?= get_sub_field('bg_image')['url']; ?>');
      }
    <?php endif; ?>

    .banner<?= $count; ?>:after {
      background-color: <?= get_sub_field( 'bg_color' ); ?>;
      <?php if ( get_sub_field( 'bg_image' )): // If there is a background image, make a colored overlay ?>
        opacity: <?= get_sub_field( 'bg_opacity' )/100; ?>;
      <?php endif; // Otherwise leave it as solid background color ?>
    }

    <?php if (get_sub_field( 'text_bg_color' )): ?>
      .banner<?= $count; ?> .banner__content:before {
        opacity: <?= get_sub_field( 'text_bg_opacity' )/100; ?>;
        background-color: <?= get_sub_field( 'text_bg_color' ); ?>;
      }
    <?php endif; ?>

<?php //**************** Standard content section ****************/ ?>
<?php elseif ( get_row_layout() == 'standard_content' ): ?>
<?php if(get_sub_field('bg_image')) : ?>
  .standard<?= $count; ?>:before {
    background-image: url('<?= get_sub_field('bg_image')['url']; ?>');
  }
<?php endif; ?>

  .standard<?= $count; ?>:after {
    <?php if ( get_sub_field( 'bg_image' )): ?>
      opacity: <?= get_sub_field( 'bg_opacity' )/100; ?>;
    <?php endif; ?>
    background-color: <?= get_sub_field( 'bg_color' ); ?>;
  }

  <?php if (get_sub_field( 'text_bg_color' )): ?>
    .standard<?= $count; ?> .standard__content:before {
      opacity: <?= get_sub_field( 'text_bg_opacity' )/100; ?>;
      background-color: <?= get_sub_field( 'text_bg_color' ); ?>;
    }
  <?php endif; ?>

<?php //**************** Split content section ****************/ ?>
<?php elseif ( get_row_layout() == 'split_section' ): ?>
  <?php //**************** Left side ****************/ ?>
    <?php if ( have_rows( 'left' ) ): ?>
      <?php while ( have_rows( 'left' ) ): the_row(); ?>

      <?php if(get_sub_field('bg_image')) : ?>
        .split<?= $count; ?> .splitLeft:before {
          background-image: url('<?= get_sub_field('bg_image')['url']; ?>');
        }
      <?php endif; ?>

        <?php if (get_sub_field( 'text_bg_color' )): // Text overlay ?>
          .split<?= $count; ?> .splitLeft__content:before {
            opacity: <?= get_sub_field( 'text_bg_opacity' )/100; ?>;
            background-color: <?= get_sub_field( 'text_bg_color' ); ?>;
          }
        <?php endif; ?>

        .split<?= $count; ?> .splitLeft:after {
          <?php if ( get_sub_field( 'bg_image' )): ?>
            opacity: <?= get_sub_field( 'bg_opacity' )/100; ?>;
          <?php endif; ?>
          background-color: <?= get_sub_field( 'bg_color' ); ?>;
        }
    <?php endwhile; ?>
  <?php endif; ?>
  <?php //**************** Right side ****************/ ?>
  <?php if ( have_rows( 'right' ) ): ?>
        <?php while ( have_rows( 'right' ) ): the_row(); ?>
        <?php if(get_sub_field('bg_image')) : ?>
          .split<?= $count; ?> .splitRight:before {
            background-image: url('<?= get_sub_field('bg_image')['url']; ?>');
          }
        <?php endif; ?>

          .split<?= $count; ?> .splitRight:after {
          <?php if ( get_sub_field( 'bg_image' )): ?>
            opacity: <?= get_sub_field( 'bg_opacity' )/100; ?>;
          <?php endif; ?>
            background-color: <?= get_sub_field( 'bg_color' ); ?>;
          }

        <?php if (get_sub_field( 'text_bg_color' )): ?>
          .split<?= $count; ?> .splitRight__content:before {
            opacity: <?= get_sub_field( 'text_bg_opacity' )/100; ?>;
            background-color: <?= get_sub_field( 'text_bg_color' ); ?>;
          }
        <?php endif; ?>
    <?php endwhile; ?>
  <?php endif; ?>

  <?php //**************** Post Type Grid section ****************/ ?>
  <?php elseif ( get_row_layout() == 'post_type_grid' ):
    $query = new WP_Query( array( 'post_type' => get_sub_field( 'post_type' ), 'orderby' => 'post_date',
    'order' => 'ASC' ));
    $max = get_sub_field('number_of_posts');
  ?>
    <?php if (get_sub_field('bg_color')) : ?>
      .postGrid<?=$count;?>:after {
        background-color: <?= get_sub_field('bg_color'); ?>;
      }
    <?php endif; ?>


    <?php if (count($query->posts)): $query_count = 1; ?>
      .postGrid<?=$count; ?> .postGrid__item:hover {
          background-color: <?php the_sub_field( 'hover_bg_color' ); ?>;
          color: <?php the_sub_field( 'hover_text_color' ); ?>;
          background-image: none;
        }

      <?php foreach ($query->posts as $nested_post):
        if($query_count <= $max || $max == '0'): ?>
          .postGrid<?=$count; ?> .postGrid__item<?=$query_count; ?> {
            background-image: url('<?= get_the_post_thumbnail_url($nested_post->ID); ?>');
          }
        <?php endif; ?>
      <?php $query_count++; endforeach; ?>
    <?php endif; // No more posts ?>


    <?php elseif ( get_row_layout() == 'slider' ): ?>
      <?php if(get_sub_field('bg_image')) : ?>
        .slider<?=$count;?>:before {
          background-image: url('<?= get_sub_field('bg_image')['url']; ?>');
        }
      <?php endif;?>

        .slider<?= $count; ?>:after {
          <?php if ( get_sub_field( 'bg_image' )): ?>
            opacity: <?= get_sub_field( 'bg_opacity' )/100; ?>;
          <?php endif; ?>
          background-color: <?= get_sub_field( 'bg_color' ); ?>;
        }

        <?php if ( have_rows( 'slide' ) ) : $slide_count = 1; ?>
          <?php while ( have_rows( 'slide' ) ) : the_row(); ?>
        .slider<?=$count;?> .glide__slide<?=$slide_count;?> {
          background-image: url('<?= get_sub_field('image')['url']; ?>');
        }
      <?php $slide_count++; endwhile;?>
    <?php endif; ?>

    <?php elseif ( get_row_layout() == 'donate' ) : ?>
    <?php if(get_sub_field('bg_image')) : ?>
        .donate<?=$count;?>:before {
          background-image: url('<?= get_sub_field('bg_image')['url']; ?>');
        }
      <?php endif; ?>
        .donate<?= $count; ?>:after {
          <?php if ( get_sub_field( 'bg_image' )): ?>
            opacity: <?= get_sub_field( 'bg_opacity' )/100; ?>;
          <?php endif; ?>
          background-color: <?= get_sub_field( 'bg_color' ); ?>;
        }

        <?php if (get_sub_field( 'text_bg_color' )): ?>
          .donate<?= $count; ?> .donate__content:before {
            opacity: <?= get_sub_field( 'text_bg_opacity' )/100; ?>;
            background-color: <?= get_sub_field( 'text_bg_color' ); ?>;
          }
        <?php endif; ?>


<?php endif; // End of layouts ?>
<?php $count++; endwhile; // End of while flex rows ?>
<?php endif; // End of if flex rows ?>
