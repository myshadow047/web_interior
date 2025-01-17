<?php

?>

<h3>Invoke <?php echo $CI->uri->rsegments[3] . '/' . $CI->uri->rsegments[4] ?></h3>
<?php if (empty($_GET['confirmed'])): ?>
    <form method="get" action="<?php echo current_url() ?>" class="ajaxform">
        <input type="hidden" name="confirmed" value="true" />
        <div class="info">
            <p>
                Are you sure want to invoke <?php echo $CI->uri->rsegments[3] . '/' . $CI->uri->rsegments[4] ?>?
            </p>
            <p>
                This may lead application error, if you experienced developer go ahead.
            </p>
        </div>
        <input type="submit" value="<?php echo l('OK') ?>" />
        <a href="#" class="btn cancel"><?php echo l('Cancel') ?></a>
    </form>
<?php else: ?>
    <div class="info">
        <pre>
<?php if (!empty($output)): ?>
<?php echo implode("\n", $output) ?>
<?php else: ?>
(no result)
<?php endif ?>
        </pre>
    </div>
    <div class="clearfix" style="padding-bottom: 5px;"></div>
    <a href="#" class="btn cancel"><?php echo l('Close') ?></a>
<?php endif ?>