<div class="page-header">
    <h3>Найдено</h3>
</div>

<span class="loader">Загрузка...</span>
<div class="search-modules">
    
</div>

<script>
    $(function(){
        $.get(BASE_URL + 'admin/modules/search', function(content){
            $(".loader").hide();
            $(".search-modules").html(content);
        });
    });
</script>