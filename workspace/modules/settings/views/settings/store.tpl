{$module} > {$view}

<div class="container">
    <form class="form-horizontal" name="create_form" id="create_form" method="post" action="/settings/create">
        <div class="form-group">
            <label for="firstname">Key:</label>
            <input type="text" name="key" id="key" class="form-control" required="required" />
        </div>
        <div class="form-group">
            <label for="lastname">Value:</label>
            <textarea rows="7" name="value" id="value" class="form-control" required="required"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit_button" class="btn btn-default" value="Submit">
        </div>
    </form>
</div>