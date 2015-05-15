var timer;

function up()
{
    timer = setTimeout(function()
    {
        var keywords = $('#search-input').val();
        var form = $('#search-input').closest('form');
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.prop('action');

        if (keywords.length > 0)
        {
            $.ajax({
                type : method,
                url : url,
                data : form.serialize(),
                beforeSend: function(){
                    $('#loading-image').show();
                },
                complete: function(){
                    $('#loading-image').hide();
                },
                success : function(response)
                {
                    $('#search-results').html(response);
                }
            });
        }
    }, 500);
}

function down()
{
    clearTimeout(timer);
}




