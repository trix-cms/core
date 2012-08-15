<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('partials/metadata')?>
</head>
<body>

<div class="wrap">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <?php $this->load->view('partials/header')?>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row-fluid content-sidebar">
            <div class="span2 sidebar">
                <?php $this->load->view('partials/sidebar')?>
            </div>
            <div class="span10">
                
                <?php echo $this->breadcrumbs->display(array(
                    'index_item'=>array('<i class="icon-home"></i>', 'admin/dashboard'),
                    'delimiter'=>' » ',
                    'item_before'=>'<li>',
                    'item_after'=>'</li>',
                    'start_tag'=>'<ul class="breadcrumb">',
                    'end_tag'=>'</ul>',
                    'show_on_index'=>FALSE
                ))?>
                
                <?php $this->notification->display()?>
            
                <?=$content?>
            </div>
        </div>           
    </div>
    
    <footer>
        <hr /> 
        <div class="footer-wrap">
            <?php $this->load->view('partials/footer')?>
        </div>
    </footer>
</div>

</body>
</html>