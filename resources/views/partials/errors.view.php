<div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <ul>
    <?php
    foreach ($errors as $field => $message) {
        printf('<li>%s</li>', $message);
    }
    ?>
    </ul>
</div>
