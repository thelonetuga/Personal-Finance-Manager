<?php
if (count($errors) > 0) {
    include 'src/views/partials/errors.view.php';
}
?>
<form action="account-edit.php" method="post" class="form-group">
    <input type="hidden" name="account_id" value="<?= $account->account_id ?>" />
    <?php require 'src/views/users/partials/add-edit.view.php'?>
    <div class="form-group">
        <button type="submit" class="btn btn-success" name="ok">Save</button>
        <button type="submit" class="btn btn-default" name="cancel">Cancel</button>
    </div>
</form>
