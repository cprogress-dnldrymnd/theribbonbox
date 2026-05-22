<div class="product-tabs trb-mt-large trb-mb-medium">
    <div class="container">
        <div class="nav-tabs-holder">
            <div class="nav-tabs-holder-inner d-flex align-items-center justify-content-between gap-3">
                <ul class="nav nav-tabs gap-2 gap-lg-5" id="tabFeatured" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="Discounts-tab" data-bs-toggle="tab" data-bs-target="#Discounts" type="button" role="tab" aria-controls="Discounts" aria-selected="true">Discounts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Products-tab" data-bs-toggle="tab" data-bs-target="#Products" type="button" role="tab" aria-controls="Products" aria-selected="false">Products</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Giveaways-tab" data-bs-toggle="tab" data-bs-target="#Giveaways" type="button" role="tab" aria-controls="Giveaways" aria-selected="false">Giveaways</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Guides-tab" data-bs-toggle="tab" data-bs-target="#Guides" type="button" role="tab" aria-controls="Guides" aria-selected="false">Guides</button>
                    </li>
                </ul>
                <div class="button-box button-box-v2 button-bordered">
                    <a href="#">ALL WELLBEING DISCOUNTS</a>
                </div>
            </div>
        </div>

        <div class="tab-content" id="tabFeaturedContent">
            <div class="tab-pane fade show active" id="Discounts" role="tabpanel" aria-labelledby="Discounts-tab">
                <?= do_shortcode('[product_widget id="49853"]') ?>
            </div>
            <div class="tab-pane fade" id="Products" role="tabpanel" aria-labelledby="Products-tab">
                <?= do_shortcode('[product_widget id="49853"]') ?>
            </div>
            <div class="tab-pane fade" id="Giveaways" role="tabpanel" aria-labelledby="Giveaways-tab">
                <?= do_shortcode('[product_widget id="49853"]') ?>
            </div>
            <div class="tab-pane fade" id="Guides" role="tabpanel" aria-labelledby="Guides-tab">
                <?= do_shortcode('[product_widget id="49853"]') ?>
            </div>
        </div>
    </div>
</div>