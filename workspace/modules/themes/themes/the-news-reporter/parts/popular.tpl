<div class="single_sidebar">
    <div class="popular">
        <h2 class="title">Newest</h2>
        <ul>
            {$i = 0}
            {foreach from=$articles item=item}
                {if $i++ < $popular}
                <li>
                    <div class="single_popular">
                        <p>{$item->updated_at}</p>
                        <h3>
                            {$item->name}
                            <a href="/read/{$item->id}" class="readmore">Read More</a>
                        </h3>
                    </div>
                </li>
                {else}
                    {break}
                {/if}
            {/foreach}
        </ul>
{*        <a href="category" class="popular_more">more</a>*}
    </div>
</div>