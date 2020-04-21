<div class="main_menu_area">
    <ul id="nav">
        {foreach from=$categories item=item}
            <li><a href="/category/{$item->id}"> {$item->category} </a></li>
        {/foreach}
    </ul>
</div>