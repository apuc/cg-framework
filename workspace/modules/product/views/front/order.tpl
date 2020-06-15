{core\App::$breadcrumbs->addItem(['text' => 'Create'])}
<div class="h1">{$h1}</div>

<div class="container">

    {if !empty($errors)}
        {foreach from=$errors item=error}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/foreach}
    {/if}

    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/testfront/order/{$product[0]->id}">
        <div class="form-group">
            <label for="city">Город:</label>
            <input type="text" name="city" id="city" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="email">Эл. почта:</label>
            <input type="text" name="email" id="email" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="fio">ФИО:</label>
            <input type="text" name="fio" id="fio" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" name="phone" id="phone" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="pay">Тип оплаты:</label>
            <input type="number" name="pay" id="pay" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="delivery">Тип доставки:</label>
            <input type="number" name="delivery" id="delivery" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="shop_id">Номер магазина:</label>
            <input type="number" name="shop_id" id="shop_id" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="delivery_date">Дата доставки:</label>
            <input type="date" name="delivery_date" id="delivery_date" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="delivery_time">Время доставки:</label>
            <input type="text" name="delivery_time" id="delivery_time" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" name="address" id="address" class="form-control" required="required"/>
        </div>
        <div class="form-group">
            <label for="comment">Комментарий:</label>
            <textarea type="text" name="comment" id="comment" class="form-control" required="required"></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Количество:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required="required"/>
        </div>
        {core\GridView::widget()
        ->deleteActionBtn('edit')
        ->deleteActionBtn('store')
        ->deleteActionBtn('delete')
        ->setParams($product, $options)
        ->run()}
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>