(function ($) {
    "Use strict";
    var HT = {};
    var $document = $(document)

    HT.getLocation = () => {
        $(document).on('change', '.location', function () {
            let _this = $(this)
            let option = {
                'data': {
                    'location_id': _this.val(),
                },
                'target': _this.attr('data-target'),
            }

            HT.sendDataTogetLocation(option)
        })
    }

    HT.sendDataTogetLocation = (option) => {
        $.ajax({
            url: '/ajax/location/getLocation',
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function (res) {
                $('.' + option.target).html(res.html)
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
            }
        });
    }

    $document.ready(function () {
        HT.getLocation();
    });

})(jQuery);