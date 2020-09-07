{assign var="url" value="{'admin/order/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->fio, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->fio}</div>

<div class="container">

    {if !empty($errors)}
        {foreach from=$errors item=error}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/foreach}
    {/if}

    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/admin/order/update/{$model->id}">
        <div class="form-group">
            <label for="city">Город:</label>
            <input type="text" name="city" id="city" class="form-control" required="required" value="{$model->city}" />
        </div>
        <div class="form-group">
            <label for="email">Эл. почта:</label>
            <input type="email" name="email" id="email" class="form-control" required="required" value="{$model->email}"/>
        </div>
        <div class="form-group">
            <label for="fio">ФИО:</label>
            <input type="text" name="fio" id="fio" class="form-control" required="required" value="{$model->fio}"/>
        </div>
        <div class="form-group">
            <label for="phone">Телефон:</label>
            <input type="text" name="phone" id="phone" class="form-control" required="required" value="{$model->phone}"/>
        </div>
        <div class="form-group">
            <label for="pay">Тип оплаты:</label>
            <input type="number" name="pay" id="pay" class="form-control" required="required" value="{$model->pay}"/>
        </div>
        <div class="form-group">
            <label for="delivery">Тип доставки:</label>
            <input type="number" name="delivery" id="delivery" class="form-control" required="required" value="{$model->delivery}"/>
        </div>
        <div class="form-group">
            <label for="shop_id">Номер магазина:</label>
            <input type="number" name="shop_id" id="shop_id" class="form-control" required="required" value="{$model->shop_id}"/>
        </div>
        <div class="form-group">
            <label for="delivery_date">Дата доставки:</label>
            <input type="date" name="delivery_date" id="delivery_date" class="form-control" required="required" value="{$model->delivery_date}"/>
        </div>
        <div class="form-group">
            <label for="delivery_time">Время доставки:</label>
            <input type="text" name="delivery_time" id="delivery_time" class="form-control" required="required" value="{$model->delivery_time}"/>
        </div>
        <div class="form-group">
            <label for="address">Адрес:</label>
            <input type="text" name="address" id="address" class="form-control" required="required" value="{$model->address}"/>
        </div>
        <div class="form-group">
            <label for="comment">Комментарий:</label>
            <textarea type="text" name="comment" id="comment" class="form-control" required="required">{$model->comment}</textarea>
        </div>
        <div class="form-group">
            <label for="total_price">Сумма заказа:</label>
            <input type="number" name="total_price" id="total_price" class="form-control" required="required" value="{$model->total_price}"/>
        </div>
        <div class="form-group">
            <label for="product_id">Номер товара:</label>
            <input type="number" name="product_id" id="product_id" class="form-control" required="required" value="{$prodmodel->product_id}"/>
        </div>
        <div class="form-group">
            <label for="quantity">кол-во:</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required="required" value="{$prodmodel->quantity}"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>