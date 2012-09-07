<?php
$jsAutoStart = $this->getValueOf('jsAutoStart', ''); // defining "CaterJS.pages" started on page autoload
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<title>Pinba Face</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<?php echo $this->_includeBlock( 'Styles' );?>

        <!--[if IE]>
        <script src="/static/skin/jquery-ui/jquery.ui.1.8.16.ie.css"></script>
        <![endif]-->

        <?php echo $this->_includeBlock( 'Scripts' );?>

    </head>
	<body data-js-autostart="<?php echo $jsAutoStart?>" data-target=".subnav" data-twttr-rendered="true" data-offset="50">

        <?php echo $this->_includeTemplate('/shared/header.tpl', true)?>

        <div class="container">

			<?php echo $this->_includeTemplate($this->_getViewTemplate())?>

			<?php echo $this->_includeTemplate('/shared/footer.tpl', true)?>



        <?php echo $this->_includeBlock( 'PinbaSettings' );?>

        <div id="info-window" class="modal hide">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Настройки сервера</h3>
            </div>
            <div class="modal-body">
            </div>
        </div>

		<!-- /container -->
        </div>
    </body>
</html>