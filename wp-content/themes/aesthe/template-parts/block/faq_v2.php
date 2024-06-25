<?php

/**
 * Block Name: Faq_v2
 *
 * 
 */
?>

<?php
if (is_admin()) : echo "<div style=\"width: 100%; padding: 40px 20px;text-align: center;font-size: 10px;background: #eee\">Faq v2</div>";
else : ?>

    <?php if (!empty(get_field("faq_titre"))) : ?>
        <section class="faqBlock faq_v2 faq_v2">
            <div class="wrapper">
                <div class="faqBlock__head">
                    <h2 class="wrapper"><?php the_field("faq_titre") ?></h2>
                </div>
                <ul>
                    <?php
                    if (have_rows('faq_champs')) :
                        while (have_rows('faq_champs')) : the_row();
                            echo "<li>";
                            echo "<button class>";
                            echo "<h3>";
                            echo get_sub_field('faq_question');
                            echo "</h3>";
                            echo "<div>";
                            echo get_sub_field('faq_reponse');
                            echo "</div>";
                            echo "</button>";
                            echo "</li>";
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
        </section>
    <?php endif ?>

<?php endif ?>