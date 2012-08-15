<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
    <?=$this->seo->site_title()?>
</title>

<script>
    var BASE_URL = '<?php echo URL::base_url()?>';
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<?=Assets::js('bootstrap.min.js')?>
<?=Theme::js('scripts.js')?>

<?=Assets::css('bootstrap.min.css')?>
<?=Theme::css('main.css')?>
<!--[if lt IE 9]>
  <?=Theme::css('ie.css')?>
<![endif]-->

<?=$this->template->metadata()?>

