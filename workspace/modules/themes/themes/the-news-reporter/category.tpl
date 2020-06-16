<div class="body_wrapper">
    <div class="center">
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/header.tpl"}
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/menu.tpl"}
        <div class="content_area">
            {foreach from=$articles item=item}
                <div class="single_left_coloum floatleft">
                    {$item->image}
                    <h3 class="title-height"> {$item->name} </h3>
                    <div class="article_text_small"><p> {$item->description} </p></div>
                    <a class="readmore" href="/read/{$item->id}">read more</a>
                </div>
            {/foreach}
        </div>
        {include file="{$workspace_dir}/modules/themes/themes/the-news-reporter/parts/footer.tpl"}
    </div>
