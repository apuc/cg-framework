{assign var="url" value="{'category/'}{$model->id}"}
{core\App::$breadcrumbs->addItem(['text' => $model->name, 'url' => {$url}])}
{core\App::$breadcrumbs->addItem(['text' => 'Edit'])}
<div class="h1">{$h1} {$model->name}</div>

<div class="container">
    <form class="form-horizontal" name="edit_form" id="edit_form" method="post" action="/category/update/{$model->id}">
        <div class="form-group">
            <label for="firstname">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required="required" value="{$model->name}" />
            <label for="firstname">Title:</label>
            <input type="text" name="title" id="title" class="form-control" required="required" value="{$model->title}" />
            <label for="firstname">Description:</label>
            <input type="text" name="description" id="description" class="form-control" required="required" value="{$model->description}" />
            <label for="firstname">Status:</label>
            <input type="text" name="status" id="status" class="form-control" required="required" value="{$model->status}" />
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>