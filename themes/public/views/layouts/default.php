<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <?php $this->load->view('::partials/metadata')?>
</head>

<body>

    <div class="wrap">
        <div class="container">
    
            <?php $this->alert->display()?>
        
            <div class="row" style="margin-left: 0; padding-bottom: 57px; padding-top: 50px;">
                <div class="well" style="border: 1px solid #ccc;">
                    <?=$content?>
                </div>
            </div>
            
            
        </div>
        
        <div class="footer">
            <hr style="margin-bottom: 10px;" />
            <?php $this->load->view('::partials/footer')?>
    	</div>
    </div>
</body>
</html>