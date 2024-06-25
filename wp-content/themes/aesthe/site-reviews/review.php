<?php defined('ABSPATH') || die;
?>

<div class="custom-review" id="review-{{ review_id }}" data-assigned='{{ assigned }}'>

    {{ rating }}
    {{ title }}
    {{ content }}

    <div class="custom-review__bottom">
        <div class="custom-review__bottom__details">
            {{ author }}
            &ensp; | &ensp;
            {{ date }}
            <!-- {{ assigned_posts }} -->
        </div>
    </div>
</div>