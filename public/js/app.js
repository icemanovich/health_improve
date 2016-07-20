/**
 * Created by ignat on 16.07.16.
 */
$(document).ready(function() {

    App = {
        /**
         * Make an order AJAX request
         * @param date
         * @param user_id
         * @param target_id
         * @param btn
         */
        make_order: function(date, user_id, target_id, btn){

            console.log('make order for ', arguments);

            $.ajax({
                url: '/order',
                method: 'post',
                data: {
                    date: date,
                    user_id: user_id,
                    target_id: target_id,
                    token: CSRF_TOKEN
                },

                success: function(data) {
                    $('.results').html(data);

                    btn.toggleClass('btn-primary', false);
                    btn.attr('available', 'false');
                    alert('Заявка успешно обработана. Время приёма: ' + date)
                },
                error: function(data){

                    console.log('ERROR', data);


                    btn.toggleClass('btn-primary', false);
                    btn.attr('available', 'false');

                    alert(data.responseJSON.data);
                }
            });
        }
    };


    /**
     * Handler for button click
     */
    $("button.make_order").click(function(data) {

        if ($(this).attr('available').toLowerCase() == 'true') {
            $args = $(this).attr('data').split(':');
            App.make_order($args[0], $args[1], $args[2], $(this));
        } else {
            alert('Время уже зарезервировано. Выберите другое.');
        }
    });

});