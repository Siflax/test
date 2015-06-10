
(function() {




    $(document).on('submit', 'form[data-remote]', function(e) {

        var form = $(this);
        var method = form.find('input[name="_method"]').val() || 'POST';
        var url = form.prop('action');
        var target = form.attr('target');

        $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            target: target,
            beforeSend: function(){
                $('#loading-image').show();
            },
            complete: function(){
                $('#loading-image').hide();
            },
            success: function(response) {

                if (this.target)
                {
                    $(this.target).html(response);
                }

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

        var link = $(this);

        if (link.parents('.tab').length) {
            $(".tab").click(function () {
                $(".tab").removeClass("active");
                link.closest('.tab').addClass("active");
            });
        }

        var url = link.attr('href');
        var target = link.attr('target');

        $.ajax({
            type: 'GET',
            url: url,
            target: target,
            beforeSend: function(){
                $('#loading-image').show();
            },
            complete: function(){
                $('#loading-image').hide();
            },
            success: function(response) {

                if (this.target)
                {
                    $(this.target).html(response);
                }

            }
        });


        e.preventDefault();
    });

})();