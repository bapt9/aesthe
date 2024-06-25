<?php defined('ABSPATH') || die; ?>

<div id="ClosedForm" class=" glsr-form-wrap-separator">
</div>
<div id="goToForm" class="glsr-form-wrap customised-form-wrap">
    <form class="{{ class }} customised-review-form" method="post" enctype="multipart/form-data">
        {{ fields }}
        {{ response }}
        <div class="customised-form-wrap__button">
            <a href="#ClosedForm">
                {{ submit_button }}
            </a>
        </div>
    </form>
</div>