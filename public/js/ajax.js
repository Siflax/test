(function() {

    $('form[data-remote]').on('submit', function(e) {

        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.prop('action');


        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            success: function() {
                var message = form.data('remote-success-message');

                if (message)
                {
                    $('.flash').html(message).fadeIn(300).delay(2000).fadeOut(300);
                }
            }
        });

        e.preventDefault();
    });

    $('input[data-confirm], button[data-confirm]').on('click', function(e) {

        var input = $(this);

        input.prop('disabled', 'disabled');

        if (! confirm(input.data('confirm'))) {
            e.preventDefault();
        }

        input.removeAttr('disabled');
    });

    $('a[data-remote]').on('click', function(e) {

        $(".tab").click(function () {
            $(".tab").removeClass("active");
            $(this).closest('.tab').addClass("active");
        });

        var url = $(this).attr('href');

        $.ajax({
            type: 'GET',
            url: url,
            beforeSend: function(){
                $('#loading-image').show();
            },
            complete: function(){
                $('#loading-image').hide();
            },
            success: function(response) {

                $('#rules').html(response);

            }
        });


        e.preventDefault();
    });

})();