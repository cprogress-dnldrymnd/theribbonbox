<!-- index-contact-page.php -->
<div class="content">
    <div class="content">
        <div class="contact-content offices-section">
            <div class="contact-location-outer">
                <div class="contact-office" style="padding: 1em; ">
                    <?php the_content(); ?>
                </div>
                <div class="contact-office" style="padding: 1em; ">

                    <?php
                    //if (the_title('','',false) == "About"){
                    if (function_exists("wd_form_maker")) {
                        echo "<div class='cf-outer'>";
                        echo wd_form_maker(1, "embedded");
                        echo "</div>";
                    }
                    // }
                    ?>
                    <!--
                    <div class="home-contact-form">
                    <h2>Enquiry Form</h2>
                        <?php //include __DIR__ . '/../functions/contact-form.php'; ?>
                    </div>  -->
                </div>
                <div class="end">&nbsp;</div>
            </div>
        </div>
    </div>
    <div class="end">&nbsp;</div>
</div>