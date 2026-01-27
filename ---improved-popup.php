
<?php if (current_user_can('administrator')) { ?>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SignUpModal">
    Launch demo modal
  </button>

  <!-- Modal -->
  <div class="modal fade" id="SignUpModal" tabindex="-1" aria-labelledby="SignUpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title fs-5" id="SignUpModalLabel">Become an insider</h2>
          <button type="button" class="btn-modal-close" data-bs-dismiss="modal" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
              <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
            </svg>
          </button>
        </div>
        <div class="modal-body" style="background-color: <?= $subscribe_popup_bg_colour ?>">

          <div class="row g-0">
            <div class="col-lg-6">
              <div class="image-box">
                <img src="<?= wp_get_attachment_image_url($subscribe_popup_image, 'large') ?>" alt="Subscribe">
              </div>
            </div>
            <div class="col-lg-6 p-3 p-lg-4 d-flex align-items-center text-center">
              <div class="content-box">
                <h2 style="color: <?= $subscribe_popup__heading_colour ?> !important"><?= $subscribe_popup_heading ?> </h2>
                <div class="discovery-links discovery-links-v2">
                  <?php foreach ($home_section_discover_links as $term) { ?>
                    <?php
                    $page_category = get_field('page_category', $term->taxonomy . '_' . $term->term_id);
                    $category_colour = get_field('category_colour', $term->taxonomy . '_' . $term->term_id);
                    $category_text_color = get_field('category_text_color', $term->taxonomy . '_' . $term->term_id);
                    $page_link = get_the_permalink($page_category[0]);
                    ?>

                    <a href="<?= $page_link ?>" style="--bg-color: <?= $category_colour ?>; --text-color: <?= $category_text_color ?>">
                      <?= $term->name ?>
                    </a>
                  <?php } ?>
                </div>


                <div id="subscribe-outer-desc" style="color: <?= $subscribe_popup_description_colour ?> !important">
                  <?= wpautop($subscribe_popup_description) ?>
                </div>

                <div class="sub---form" style="--color: <?= $subscribe_popup_form_colour ?> !important">
                  <?= do_shortcode($subscribe_popup_form); ?>
                </div>

              </div>
            </div>
          </div>
        </div>



      </div>
    </div>
  </div>
  </div>
<?php } ?>