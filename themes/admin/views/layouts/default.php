<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('::partials/metadata')?>
</head>
<body>

<div class="wrap">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <?php $this->load->view('::partials/header')?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid content">
            <div class="span12">
                <?php echo $this->breadcrumbs->display(array(
                    'index_item'=>array('<i class="icon-home"></i>', 'admin/dashboard'),
                    'delimiter'=>' » ',
                    'item_before'=>'<li>',
                    'item_after'=>'</li>',
                    'start_tag'=>'<ul class="breadcrumb">',
                    'end_tag'=>'</ul>',
                    'show_on_index'=>FALSE
                ))?>
                
                <?php $this->alert->display()?>
            
                <?=$content?>
            </div>
        </div>           
    </div>
    
    <footer>
        <?php $this->load->view('::partials/footer')?>
    </footer>
</div>

</body>
</html>