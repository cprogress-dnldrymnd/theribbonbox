<style>
   
    .product-tabs-fertility:before {
        content: '';
        position: absolute;
        background-color: var(--trb-wine);
        height: 250px;
        left: 0;
        top: 0;
        right: 0;
    }
</style>
<section class="two-columns trb-bg-wine">
    <div class="container">
        <div class="inner">
            <h2 class="trb-petal-color large-heading mb-5 trb-petal-color">Fertility</h2>
            <div class="row g-3 g-lg-5">
                <div class="col-lg-7">
                    <div class="image-box">
                        <img src="https://theribbonbox.com/wp-content/uploads/2026/05/Path-21.png" alt="">
                    </div>
                </div>
                <div class="col-lg-5">
                    <h3 class="trb-petal-color">Take Control of Your Fertility with Expert Tools and Advice</h3>
                    <div class="desc trb-petal-color">
                        <p>Explore a curated collection of fertility-enhancing supplements, tools, and resources to support your journey. From ovulation trackers to prenatal vitamins, find the products and insights that help you take the next step towards starting your family.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="product-tabs product-tabs-fertility trb-mt-large trb-mb-medium position-relative">
    <div class="container position-relative">
        <div class="nav-tabs-holder">

            <div class="nav-tabs-holder-inner d-flex align-items-center justify-content-between gap-3">
                <ul class="nav nav-tabs gap-2 gap-lg-5" id="tabFeatured" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link trb-petal-color active" id="Discounts-tab" data-bs-toggle="tab" data-bs-target="#Discounts" type="button" role="tab" aria-controls="Discounts" aria-selected="true">Discounts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link trb-petal-color" id="Products-tab" data-bs-toggle="tab" data-bs-target="#Products" type="button" role="tab" aria-controls="Products" aria-selected="false">Products</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link trb-petal-color" id="Giveaways-tab" data-bs-toggle="tab" data-bs-target="#Giveaways" type="button" role="tab" aria-controls="Giveaways" aria-selected="false">Giveaways</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link trb-petal-color" id="Guides-tab" data-bs-toggle="tab" data-bs-target="#Guides" type="button" role="tab" aria-controls="Guides" aria-selected="false">Guides</button>
                    </li>
                </ul>
                <div class="button-box button-box-v2 button-bordered">
                    <a href="#">ALL WELLBEING DISCOUNTS</a>
                </div>
            </div>
        </div>

        <div class="tab-content" id="tabFeaturedContent">
            <div class="tab-pane fade show active" id="Discounts" role="tabpanel" aria-labelledby="Discounts-tab">
                <?= do_shortcode('[product_widget id="49854"]') ?>
            </div>
            <div class="tab-pane fade" id="Products" role="tabpanel" aria-labelledby="Products-tab">
                <?= do_shortcode('[product_widget id="49854"]') ?>
            </div>
            <div class="tab-pane fade" id="Giveaways" role="tabpanel" aria-labelledby="Giveaways-tab">
                <?= do_shortcode('[product_widget id="49854"]') ?>
            </div>
            <div class="tab-pane fade" id="Guides" role="tabpanel" aria-labelledby="Guides-tab">
                <?= do_shortcode('[product_widget id="49854"]') ?>
            </div>
        </div>
    </div>
</div>