<p style="margin: 20px 0;">
    Укажите ваш действующий email. На него будет выслано письмо с паролем для входа на сайт.
</p>

<form action="" method="post" class="form-horizontal">

	<div class="control-group">
        <label class="control-label" for="email">Email</label>
        <div class="controls">
            <input 
                type="text" 
                value=""
                name="email"
            />
        </div>
    </div>
    <?php if( $referer ):?>
    <div class="control-group">
        <label class="control-label" for="referer">ID реферера</label>
        <div class="controls">
            <input 
                type="text" 
                value="<?=$referer?>"
                name="referer"
                style="width: 30px; text-align: right;"
                disabled="disabled"
            />
        </div>
    </div>
    <?php endif;?>
    
	<div class="form-actions">
		<input 
            value="Я согласен с правилами, зарегистрироваться" 
            type="submit"
            name="submit" 
            class="btn btn-success"
        />
	</div>
</form>

<div>
    <?php $this->load->view('rules')?>
</div>