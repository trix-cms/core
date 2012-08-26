<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Админка</title>

<script>
    var BASE_URL = '<?php echo URL::base_url()?>';
</script>

<?=Assets::css('bootstrap.min.css')?>
<?=Assets::css('FortAwesome/css/font-awesome.css')?>
<?=Assets::theme_css('style.css')?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<?=Assets::js('bootstrap.min.js')?>
<?=Assets::theme_js('scripts.js')?>

<?=$this->template->metadata()?>

<?php Trix\WYSIWYG::init(Trix\WYSIWYG::TINYMCE)?>

<!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->