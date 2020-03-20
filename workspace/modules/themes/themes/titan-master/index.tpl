<html>
{include file="{$workspace_dir}/modules/themes/themes/titan-master/assets/resources.tpl"}
<head>
  {$smarty.capture.meta}
  <title>Titan</title>
  {*    <title>{$smarty.capture.title}</title>*}
  {$smarty.capture.css}
  {$smarty.capture.js_head}
</head>
<body>
    <main>
      <div class="page-loader">
        <div class="loader">Loading...</div>
      </div>
      <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><a class="navbar-brand" href="index.html">Titan</a>
          </div>
          <div class="collapse navbar-collapse" id="custom-collapse">
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Home</a>
                <ul class="dropdown-menu">
                  <li><a href="index_mp_fullscreen_video_background.html">Default</a></li>
                  <li><a href="index_op_fullscreen_gradient_overlay.html">One Page</a></li>
                  <li><a href="index_agency.html">Agency</a></li>
                  <li><a href="index_portfolio.html">Portfolio</a></li>
                  <li><a href="index_restaurant.html">Restaurant</a></li>
                  <li><a href="index_finance.html">Finance</a></li>
                  <li><a href="index_landing.html">Landing Page</a></li>
                  <li><a href="index_photography.html">Photography</a></li>
                  <li><a href="index_shop.html">Shop</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Headers</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Static Image Header</a>
                    <ul class="dropdown-menu">
                      <li><a href="index_mp_fullscreen_static.html">Fulscreen</a></li>
                      <li><a href="index_mp_classic_static.html">Classic</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Flexslider Header</a>
                    <ul class="dropdown-menu">
                      <li><a href="index_mp_fullscreen_flexslider.html">Fulscreen</a></li>
                      <li><a href="index_mp_classic_flexslider.html">Classic</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Video Background Header</a>
                    <ul class="dropdown-menu">
                      <li><a href="index_mp_fullscreen_video_background.html">Fulscreen</a></li>
                      <li><a href="index_mp_classic_video_background.html">Classic</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Text Rotator Header</a>
                    <ul class="dropdown-menu">
                      <li><a href="index_mp_fullscreen_text_rotator.html">Fulscreen</a></li>
                      <li><a href="index_mp_classic_text_rotator.html">Classic</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gradient Overlay Header</a>
                    <ul class="dropdown-menu">
                      <li><a href="index_mp_fullscreen_gradient_overlay.html">Fulscreen</a></li>
                      <li><a href="index_mp_classic_gradient_overlay.html">Classic</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pages</a>
                <ul class="dropdown-menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">About</a>
                    <ul class="dropdown-menu">
                      <li><a href="about1.html">About 1</a></li>
                      <li><a href="about2.html">About 2</a></li>
                      <li><a href="about3.html">About 3</a></li>
                      <li><a href="about4.html">About 4</a></li>
                      <li><a href="about5.html">About 5</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Services</a>
                    <ul class="dropdown-menu">
                      <li><a href="service1.html">Service 1</a></li>
                      <li><a href="service2.html">Service 2</a></li>
                      <li><a href="service3.html">Service 3</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Pricing</a>
                    <ul class="dropdown-menu">
                      <li><a href="pricing1.html">Pricing 1</a></li>
                      <li><a href="pricing2.html">Pricing 2</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Gallery</a>
                    <ul class="dropdown-menu">
                      <li><a href="gallery_col_2.html">2 Columns</a></li>
                      <li><a href="gallery_col_3.html">3 Columns</a></li>
                      <li><a href="gallery_col_4.html">4 Columns</a></li>
                      <li><a href="gallery_col_6.html">6 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Contact</a>
                    <ul class="dropdown-menu">
                      <li><a href="contact1.html">Contact 1</a></li>
                      <li><a href="contact2.html">Contact 2</a></li>
                      <li><a href="contact3.html">Contact 3</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Restaurant menu</a>
                    <ul class="dropdown-menu">
                      <li><a href="restaurant_menu1.html">Menu 2 Columns</a></li>
                      <li><a href="restaurant_menu2.html">Menu 3 Columns</a></li>
                    </ul>
                  </li>
                  <li><a href="login_register.html">Login / Register</a></li>
                  <li><a href="faq.html">FAQ</a></li>
                  <li><a href="404.html">Page 404</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Portfolio</a>
                <ul class="dropdown-menu" role="menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                    <ul class="dropdown-menu">
                      <li><a href="portfolio_boxed_col_2.html">2 Columns</a></li>
                      <li><a href="portfolio_boxed_col_3.html">3 Columns</a></li>
                      <li><a href="portfolio_boxed_col_4.html">4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed - Gutter</a>
                    <ul class="dropdown-menu">
                      <li><a href="portfolio_boxed_gutter_col_2.html">2 Columns</a></li>
                      <li><a href="portfolio_boxed_gutter_col_3.html">3 Columns</a></li>
                      <li><a href="portfolio_boxed_gutter_col_4.html">4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                    <ul class="dropdown-menu">
                      <li><a href="portfolio_full_width_col_2.html">2 Columns</a></li>
                      <li><a href="portfolio_full_width_col_3.html">3 Columns</a></li>
                      <li><a href="portfolio_full_width_col_4.html">4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width - Gutter</a>
                    <ul class="dropdown-menu">
                      <li><a href="portfolio_full_width_gutter_col_2.html">2 Columns</a></li>
                      <li><a href="portfolio_full_width_gutter_col_3.html">3 Columns</a></li>
                      <li><a href="portfolio_full_width_gutter_col_4.html">4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                    <ul class="dropdown-menu">
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Boxed</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_masonry_boxed_col_2.html">2 Columns</a></li>
                          <li><a href="portfolio_masonry_boxed_col_3.html">3 Columns</a></li>
                          <li><a href="portfolio_masonry_boxed_col_4.html">4 Columns</a></li>
                        </ul>
                      </li>
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Full Width</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_masonry_full_width_col_2.html">2 Columns</a></li>
                          <li><a href="portfolio_masonry_full_width_col_3.html">3 Columns</a></li>
                          <li><a href="portfolio_masonry_full_width_col_4.html">4 Columns</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Hover Style</a>
                    <ul class="dropdown-menu">
                      <li><a href="portfolio_hover_black.html">Black</a></li>
                      <li><a href="portfolio_hover_gradient.html">Gradient</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                    <ul class="dropdown-menu">
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Image</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_single_featured_image1.html">Style 1</a></li>
                          <li><a href="portfolio_single_featured_image2.html">Style 2</a></li>
                        </ul>
                      </li>
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Slider</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_single_featured_slider1.html">Style 1</a></li>
                          <li><a href="portfolio_single_featured_slider2.html">Style 2</a></li>
                        </ul>
                      </li>
                      <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Featured Video</a>
                        <ul class="dropdown-menu">
                          <li><a href="portfolio_single_featured_video1.html">Style 1</a></li>
                          <li><a href="portfolio_single_featured_video2.html">Style 2</a></li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>
                <ul class="dropdown-menu" role="menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Standard</a>
                    <ul class="dropdown-menu">
                      <li><a href="blog_standard_left_sidebar.html">Left Sidebar</a></li>
                      <li><a href="blog_standard_right_sidebar.html">Right Sidebar</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Grid</a>
                    <ul class="dropdown-menu">
                      <li><a href="blog_grid_col_2.html">2 Columns</a></li>
                      <li><a href="blog_grid_col_3.html">3 Columns</a></li>
                      <li><a href="blog_grid_col_4.html">4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Masonry</a>
                    <ul class="dropdown-menu">
                      <li><a href="blog_grid_masonry_col_2.html">2 Columns</a></li>
                      <li><a href="blog_grid_masonry_col_3.html">3 Columns</a></li>
                      <li><a href="blog_grid_masonry_col_4.html">4 Columns</a></li>
                    </ul>
                  </li>
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Single</a>
                    <ul class="dropdown-menu">
                      <li><a href="blog_single_left_sidebar.html">Left Sidebar</a></li>
                      <li><a href="blog_single_right_sidebar.html">Right Sidebar</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Features</a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="alerts-and-wells.html"><i class="fa fa-bolt"></i> Alerts and Wells</a></li>
                  <li><a href="buttons.html"><i class="fa fa-link fa-sm"></i> Buttons</a></li>
                  <li><a href="tabs_and_accordions.html"><i class="fa fa-tasks"></i> Tabs &amp; Accordions</a></li>
                  <li><a href="content_box.html"><i class="fa fa-list-alt"></i> Contents Box</a></li>
                  <li><a href="forms.html"><i class="fa fa-check-square-o"></i> Forms</a></li>
                  <li><a href="icons.html"><i class="fa fa-star"></i> Icons</a></li>
                  <li><a href="progress-bars.html"><i class="fa fa-server"></i> Progress Bars</a></li>
                  <li><a href="typography.html"><i class="fa fa-font"></i> Typography</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Shop</a>
                <ul class="dropdown-menu" role="menu">
                  <li class="dropdown"><a class="dropdown-toggle" href="#" data-toggle="dropdown">Product</a>
                    <ul class="dropdown-menu">
                      <li><a href="shop_product_col_3.html">3 columns</a></li>
                      <li><a href="shop_product_col_4.html">4 columns</a></li>
                    </ul>
                  </li>
                  <li><a href="shop_single_product.html">Single Product</a></li>
                  <li><a href="shop_checkout.html">Checkout</a></li>
                </ul>
              </li>
              <li class="dropdown"><a class="dropdown-toggle" href="documentation.html" data-toggle="dropdown">Documentation</a>
                <ul class="dropdown-menu">
                  <li><a href="documentation.html#contact">Contact Form</a></li>
                  <li><a href="documentation.html#reservation">Reservation Form</a></li>
                  <li><a href="documentation.html#mailchimp">Mailchimp</a></li>
                  <li><a href="documentation.html#gmap">Google Map</a></li>
                  <li><a href="documentation.html#plugin">Plugins</a></li>
                  <li><a href="documentation.html#changelog">Changelog</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <section class="bg-dark-30 showcase-page-header module parallax-bg" data-background="/workspace/modules/themes/themes/titan/assets/images/showcase_bg.jpg">
        <div class="titan-caption">
          <div class="caption-content">
            <div class="font-alt mb-30 titan-title-size-1">Powerful. Multipurpose.</div>
            <div class="font-alt mb-40 titan-title-size-4">100+ Layouts</div><a class="section-scroll btn btn-border-w btn-round" href="#demos">See Demos</a>
          </div>
        </div>
      </section>
      <div class="main showcase-page">
        <section class="module-extra-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-8 col-lg-9">
                <div class="callout-text font-alt">
                  <h4 style="margin-top: 0px; font-;">Start Creating Beautiful Websites</h4>
                  <p style="margin-bottom: 0px;">Download Titan Free today!</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="callout-btn-box"><a class="btn btn-border-w btn-circle" href="https://themewagon.com/themes/titan/">Downlaod Free</a></div>
              </div>
            </div>
          </div>
        </section>
        <section class="module-medium" id="demos">
          <div class="container">
            <div class="row multi-columns-row">
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_mp_fullscreen_video_background.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/main_demo.jpg" alt="Main Demo"></div>
                  <h3 class="content-box-title font-serif">Main Demo</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_agency.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/agency.jpg" alt="Agency"></div>
                  <h3 class="content-box-title font-serif">Agency</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_portfolio.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/portfolio.jpg" alt="Portfolio"></div>
                  <h3 class="content-box-title font-serif">Portfolio</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_restaurant.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/restaurant.jpg" alt="Restaurant"></div>
                  <h3 class="content-box-title font-serif">Restaurant</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_finance.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/finance.jpg" alt="Finance"></div>
                  <h3 class="content-box-title font-serif">Finance</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_landing.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/landing.jpg" alt="Landing"></div>
                  <h3 class="content-box-title font-serif">Landing</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_photography.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/photography.jpg" alt="Photography"></div>
                  <h3 class="content-box-title font-serif">Photography</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_shop.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/shop.jpg" alt="Shop"></div>
                  <h3 class="content-box-title font-serif">Shop</h3></a></div>
              <div class="col-md-4 col-sm-6 col-xs-12"><a class="content-box" href="index_op_fullscreen_gradient_overlay.html">
                  <div class="content-box-image"><img src="/workspace/modules/themes/themes/titan-master/assets/images/screenshots/one_page.jpg" alt="One Page"></div>
                  <h3 class="content-box-title font-serif">One Page</h3></a></div>
            </div>
          </div>
        </section>
        <section class="module-extra-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-md-8 col-lg-9">
                <div class="callout-text font-alt">
                  <h4 style="margin-top: 0px;">Start Creating Beautiful Websites</h4>
                  <p style="margin-bottom: 0px;">Download Titan Free today!</p>
                </div>
              </div>
              <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="callout-btn-box"><a class="btn btn-border-w btn-circle" href="https://themewagon.com/themes/titan/">Downlaod Free</a></div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>
    {$smarty.capture.js_body}
</body>