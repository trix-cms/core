<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Панель управления</title>

<script>
    var BASE_URL = '<?php echo URL::base_url()?>';
</script>

<?=Assets::css('bootstrap.min.css')?>
<?=Assets::css('FortAwesome/css/font-awesome.css')?>
<?=Assets::theme_css('style.css')?>

<?=jQuery::render('cdn')?>
<?=Assets::js('bootstrap.min.js')?>
<?=Assets::theme_js('scripts.js')?>

<?=$this->template->metadata()?>

<?php //Trix\WYSIWYG::init(Trix\WYSIWYG::TINYMCE)?>

<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->