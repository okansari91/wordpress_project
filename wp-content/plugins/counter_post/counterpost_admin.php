<?php
if ($_POST['counterpost_hidden'] == 'Y') {
    $show_counterpost = $_POST['show_counterpost'];
    update_option('show_counterpost', $show_counterpost);
    ?>
    <div>
        <p>
            <strong><?php _e('Options saved.'); ?></strong>
        </p>
    </div>
    <?php
} else {
    //Normal page display
    $show_counterpost = get_option('show_counterpost');
}
?>

<div class="wrap">
    <?php echo "<h2>" . __('Display Options') . "</h2>"; ?>
    <hr>
    <form name="counterpost_form" method="post" action="">
        <input type="hidden" name="counterpost_hidden" value="Y">
        Yes <input type="radio" name="show_counterpost" value="yes" <?php echo ($show_counterpost == "yes") ? "checked" : ""; ?>>
        No <input type="radio" name="show_counterpost" value="no" <?php echo ($show_counterpost == "no") ? "checked" : ""; ?>>

        <input type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
    </form>
</div>