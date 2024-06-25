<?php defined('ABSPATH') || die;

global $post;
?>

<?php
// if ($post->ID == 1925) :
?>
    <!-- <div class="customised-reviews-summary wrapper">

        <div class="customised-reviews-summary__avis">
            {{ text }}
            {{ stars }}
        </div>

        <div class=" customised-reviews-summary__verifiedAvis">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/verified.svg" alt="">
            <span><?php pll_e('ReviewsAvisVerifie'); ?></span>
        </div>
        <div class="customised-reviews-summary__verifiedAvisTexte">
            <?php pll_e('ReviewsAvisVerifieTexte'); ?>
        </div>

        <div class="customised-reviews-summary__avis__bottom">

            <div class="customised-reviews-summary__avis__bottom__percentages">
                {{ percentages }}
                <div class="customised-reviews-summary__button">

                    <a href="#goToForm" id="give-reviews" class="customised-reviews-summary__avis__bottom__button">
                        <?php pll_e('ReviewsDonnezAvis'); ?>
                    </a>
                </div>
            </div>


            <div class="customised-reviews-summary__avis__bottom__rating">
                <div class="customised-reviews-summary__avis__bottom__rating__rate">
                    {{ rating }} <span class="onFive">/5</span>
                </div>
                <p><?php pll_e('ReviewsResumeNote'); ?>
                </p>
            </div>

        </div>
    </div> -->

<?php
// else :
?>
    <div class="customised-reviews-summary-posts wrapper">

        <div class="customised-reviews-summary-posts__avis">
            <p>Les avis de nos client.e.s</p>
        </div>

        <div class="customised-reviews-summary-posts__rate">
            {{ stars }}
            <a href="#goToReviews">{{ text }}</a>
        </div>
        <?php
        if (
            $post->post_type == 'tech-meds' || $post->post_type ==
            'offre' ||
            $post->post_title == 418 ||
            $post->post_title == 1560 ||
            $post->post_title == 1569 ||
            $post->post_title == 1565
        ) :
        ?>
            <a href="#goToForm" id="give-reviews" class="customised-reviews-summary__button__otherPages customised-reviews-summary__avis__bottom__button">
                <?php pll_e('ReviewsDonnezAvis'); ?>
            </a>
        <?php
        endif
        ?>
        <div class="customised-reviews-summary__verifiedAvis">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/verified.svg" alt="">
            <span><?php pll_e('ReviewsAvisVerifie'); ?></span>
        </div>
        <div class="customised-reviews-summary-posts__verifiedAvisTexte">
            <?php pll_e('ReviewsAvisVerifieTexte'); ?>
        </div>

    </div>
<?php
// endif;
?>