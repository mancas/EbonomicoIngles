<script type="text/javascript">
    $(document).ready(function() {
        $('a.delete').click(function(event) {
            event.preventDefault();
            $id = $(this).attr('href');

            $('#yes').bind('click', function(event){
                event.preventDefault();
                deleteItem($item, $id);
                $('.dialog').hide();
            })
            
            $('.dialog').show();

        });

        $('a#no').bind('click', function(event) {
            event.preventDefault();
            $('.dialog').hide();
        });
        
        $('#close-dialog').bind('click', function(){
            $('.dialog').hide();
        });
    }); 
</script>