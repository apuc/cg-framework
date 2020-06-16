{foreach from=$categories item=category}
    <div class="single_left_coloum_wrapper">
        <h2 class="title"> {$category->category} </h2>
        <a class="more" href="/category/{$category->id}">more</a>
        {$i = 0}
        {foreach from=$articles item=item}
            {foreach from=$article_category item=ac}
                {if $ac->article_id == $item->id && $ac->category_id == $category->id}
                    {if $i++ < $amount}
                        <div class="single_left_coloum floatleft">
                            {$item->image}
                            <h3 class="title-height"> {$item->name} </h3>
                            <div class="article_text_small"><p> {$item->description} </p></div>
                            <a class="readmore" href="/read/{$item->id}">read more</a>
                        </div>
                    {else}
                        {break}
                    {/if}
                {/if}
            {/foreach}
        {/foreach}
    </div>
{/foreach}