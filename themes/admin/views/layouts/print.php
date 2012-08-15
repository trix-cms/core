<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <?php echo Theme::css('bootstrap.min.css')?>
</head>
<body>

    <?php echo $content?>

    <?php echo $this->template->metadata()?>
</body>
</html>