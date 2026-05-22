<div class="product-tabs trb-my-large">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
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
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Discounts" role="tabpanel" aria-labelledby="Discounts-tab">
                <?= do_shortcode('[product_widget id="49836"]') ?>
            </div>
            <div class="tab-pane fade" id="Products" role="tabpanel" aria-labelledby="Products-tab">
                <?= do_shortcode('[product_widget id="49332"]') ?>
            </div>
            <div class="tab-pane fade" id="Giveaways" role="tabpanel" aria-labelledby="Giveaways-tab">
                <?= do_shortcode('[product_widget id="49836"]') ?>
            </div>
            <div class="tab-pane fade" id="Guides" role="tabpanel" aria-labelledby="Guides-tab">
                <?= do_shortcode('[product_widget id="49836"]') ?>
            </div>
        </div>
    </div>
</div>