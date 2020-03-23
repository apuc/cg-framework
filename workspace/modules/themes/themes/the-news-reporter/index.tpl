<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
{include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/assets/resources.tpl"}
  <head>
    {$smarty.capture.meta}
    <title>The News Reporter</title>
    {$smarty.capture.css}
    {$smarty.capture.js_head}
  </head>
  <body>
    <div class="body_wrapper">
      <div class="center">
        <div class="header_area">
          <div class="logo floatleft">
            <a href="#">
              <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/logo.png" alt="" />
            </a>
          </div>
          <div class="top_menu floatleft">
            <ul>
              <li><a href="/">Home</a></li>
              <li><a href="#">About</a></li>
              <li><a href="#">Subscribe</a></li>
            </ul>
          </div>
          <div class="social_plus_search floatright">
            <div class="social">
              <ul>
  {*              <li><a href="#" class="twitter"></a></li>*}
  {*              <li><a href="#" class="facebook"></a></li>*}
  {*              <li><a href="#" class="feed"></a></li>*}
  {*            </ul>*}
            </div>
            <div class="search">
              <form action="#" method="post" id="search_form">
                <input type="text" value="Search news" id="s" />
                <input type="submit" id="searchform" value="search" />
                <input type="hidden" value="post" name="post_type" />
              </form>
            </div>
          </div>
        </div>
        <div class="main_menu_area">
          <ul id="nav">
            {foreach from=$categories item=item}
              <li><a href="category"> {$item->category} </a></li>
            {/foreach}
          </ul>
        </div>
  {*      <div class="slider_area">*}
  {*        <div class="slider">*}
  {*          <ul class="bxslider">*}
  {*            <li><img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/1.jpg" alt="" title="Slider caption text" /></li>*}
  {*            <li><img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/2.jpg" alt="" title="Slider caption text" /></li>*}
  {*            <li><img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/3.jpg" alt="" title="Slider caption text" /></li>*}
  {*          </ul>*}
  {*        </div>*}
  {*      </div>*}
        <div class="content_area">
          <div class="main_content floatleft">
            <div class="left_coloum floatleft">

              {foreach from=$categories item=category}
                <div class="single_left_coloum_wrapper">
                  <h2 class="title"> {$category->category} </h2>
                  <a class="more" href="category">more</a>

                  {foreach from=$articles item=item}
                    <div class="single_left_coloum floatleft">
                      <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/news.jpg" alt="" />
                      <h3> {$item->name} </h3>
                      <p> {$item->text} </p>
                      <a class="readmore" href="read">read more</a>
                    </div>
                  {/foreach}
                </div>
              {/foreach}

              <div class="single_left_coloum_wrapper gallery">
                <h2 class="title">gallery</h2>
                <a class="more" href="#">more</a>

                {for $foo=1 to 7}
                  <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/news.jpg" alt="" />
                {/for}
              </div>

  {*            <div class="single_left_coloum_wrapper single_cat_left">*}
  {*              <h2 class="title">tech news</h2>*}
  {*              <a class="more" href="category">more</a>*}

  {*              {foreach from=$articles item=item}*}
  {*                <div class="single_cat_left_content floatleft">*}
  {*                  <h3> {$item->name} </h3>*}
  {*                  <p> {$item->text} </p>*}
  {*                  <p class="single_cat_left_content_meta">by <span>John Doe</span> |  29 comments</p>*}
  {*                </div>*}
  {*              {/foreach}*}
  {*            </div>*}

            </div>
          </div>
          <div class="sidebar floatright">
            <div class="single_sidebar"> <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add1.png" alt="" /> </div>
  {*          <div class="single_sidebar">*}
  {*            <div class="news-letter">*}
  {*              <h2>Sign Up for Newsletter</h2>*}
  {*              <p>Sign up to receive our free newsletters!</p>*}
  {*              <form action="#" method="post">*}
  {*                <input type="text" value="Name" id="name" />*}
  {*                <input type="text" value="Email Address" id="email" />*}
  {*                <input type="submit" value="SUBMIT" id="form-submit" />*}
  {*              </form>*}
  {*              <p class="news-letter-privacy">We do not spam. We value your privacy!</p>*}
  {*            </div>*}
  {*          </div>*}
            <div class="single_sidebar">
              <div class="popular">
                <h2 class="title">Popular</h2>
                <ul>

                  {foreach from=$articles item=item}
                    <li>
                      <div class="single_popular">
                        <p>Sept 24th 2045</p>
                        <h3>
                          {$item->name}
                          <a href="read" class="readmore">Read More</a>
                        </h3>
                      </div>
                    </li>
                  {/foreach}
                </ul>
                <a href="category" class="popular_more">more</a> </div>
            </div>
            <div class="single_sidebar"> <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add1.png" alt="" /> </div>
            <div class="single_sidebar">
              <h2 class="title">ADD</h2>
              <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add2.png" alt="" /> </div>
          </div>
        </div>
  {*      <div class="footer_top_area">*}
  {*        <div class="inner_footer_top">*}
  {*          <img class="pos" src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add3.png" alt="" />*}
  {*        </div>*}
  {*      </div>*}
        <div class="footer_bottom_area">
          <div class="copyright_text">
            <p>Copyright &copy; 2045 The News Reporter</p>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>