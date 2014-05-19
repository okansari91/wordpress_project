<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
get_header();
?>




<script type="text/javascript">
    (function($) {
        $("document").ready(function($) {
            $(".submit_button").click(function() {
//                $(this).css("border", "2px solid red");

                $.post('wp-admin/admin-ajax.php', {
                    action: "counter_increment",
                    post_id: $(this).attr("id")
                }, function(data) {
                    $("#hit_count").html(data);
                });
                return false;
            });
        });
    })(jQuery);

</script>

<div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
        <?php
        // Start the Loop.
        while (have_posts()) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part('content', get_post_format());

            // Previous/next post navigation.
            twentyfourteen_post_nav();

            if(get_option('show_counterpost') == 'yes'):
                $counter_variable = get_post_meta($post->ID, 'hit_count', TRUE);
                ?>
                <br>
                <input type="button" value="<?php _e('Hit to Increment', 'counter_post'); ?>" class="submit_button"  id="<?php the_id(); ?>">
                <span id="hit_count" style="font-size: 50px; color: green;"><?php _e($counter_variable, 'counter_post'); ?></span>
                <br>
                <?php
            endif;
            
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
        endwhile;
        ?>
    </div><!-- #content -->
</div><!-- #primary -->

<?php
get_sidebar('content');
get_sidebar();
get_footer();
