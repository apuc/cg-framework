<div class="body_wrapper">
    <div class="center">
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/header.tpl"}
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/menu.tpl"}
        <div class="content_area">
            <div class="main_content floatleft">
                <div class="left_coloum floatleft">
                    <h1 class="article_title">{$article->name}</h1>
                    <div class="article_img">{$article->image}</div>
                    <div class="article_text">{$article->text}</div>
                </div>
            </div>

            <div class="sidebar floatright">
                <div class="single_sidebar">
                    <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add1.png" alt="" />
                </div>

                {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/popular.tpl"}

                <div class="single_sidebar">
                    <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add1.png" alt="" />
                </div>
                <div class="single_sidebar">
                    <h2 class="title">ADD</h2>
                    <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/add2.png" alt="" />
                </div>
            </div>
        </div>
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/footer.tpl"}
    </div>
</div>