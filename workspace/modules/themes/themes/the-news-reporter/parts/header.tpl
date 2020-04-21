<div class="header_area">
    <div class="logo floatleft">
        <a href="/">
            <img src="/workspace/modules/themes/themes/the-news-reporter/assets/images/logo.png" alt="" />
        </a>
    </div>
    <div class="top_menu floatleft">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="">Subscribe</a></li>
            {if $role}
                <li><a href="/logout">Logout</a></li>
            {else}
                <li><a href="/sign-in">Sign In</a></li>
                <li><a href="/sign-up">Sign Up</a></li>
            {/if}
        </ul>
    </div>
    <div class="social_plus_search floatright">
        {if $username}
            <div class="social">Hi, {$username}</div>
        {else}
            <div class="social"></div>
        {/if}
        <div class="search">
            <form action="#" method="post" id="search_form">
                <input type="text" value="Search news" id="s" />
                <input type="submit" id="searchform" value="search" />
                <input type="hidden" value="post" name="post_type" />
            </form>
        </div>
    </div>
</div>