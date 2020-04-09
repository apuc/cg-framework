<div class="h1">{$h1}</div>

<a href="/article/create" class="btn btn-dark">Create</a>
<a href="" class="btn btn-dark get-articles">Get Articles</a>
{core\GridView::widget()->setParams($model, $options)->run()}

{*<select id="cars" multiple>*}
{*    <option value="volvo">Volvo</option>*}
{*    <option value="saab">Saab</option>*}
{*    <option value="opel">Opel</option>*}
{*    <option value="audi">Audi</option>*}
{*</select>*}
