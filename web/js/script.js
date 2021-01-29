$(document).ready(function () {

    // Change photo on select
    $('.select-image').change(function () {
        readURL($(this));
    });

    // Remove photo when selected
    $('.remove-photo').click(function () {
        $('.select-image').val('');
        $('.select-image').parents('.image-upload').find('img').attr('src', '/web/images/placeholder.jpg');
        $(this).hide();
    });

    // Clear fields button
    $('.clear-fields').click(function (e) {
        e.preventDefault();
        $('input:not(#orders-price):not(.qty)').val('');
        $('.select-handle').click();
    });

    // Products select logic
    $('.overall').val($('.qty').prevAll('select').find('option[selected=selected]').data('price'));
    $('.add-product-select .qty').change(function () {
        var select_el = $(this).prevAll('select').find('option[selected=selected]'),
            select_el_id = $(select_el).data('id'),
            qty = $(this).val();
        $(select_el).attr('value', $(select_el).data('name') + ' , ' + $(select_el).data('format') + ', ' + qty + ' dona');
        $('.overall').val($(select_el).data('price') * qty);
    });
    $('.add-history .qty').change(function () {
        var select_el = $(this).prevAll('select').find('option[selected=selected]'),
            select_el_id = $(select_el).data('id'),
            qty = $(this).val();
        $(select_el).attr('value', $(select_el).data('id') + ',' + $(select_el).data('name') + ',' + $(select_el).data('format') + ':' + qty);
        $('.overall').val($(select_el).data('price') * qty);
    });

    // One more select product
    $('.one-more').click(function (e) {
        e.preventDefault();
        $('.hidden-select').first().removeClass('hidden-select');
    });

    // Hide one more select product
    $('.remove-product-select').click(function () {
        $(this).parent().addClass('hidden-select');
    });

    // Collect selects of products from add-order page and write it in the input
    $('.add-order').click(function () {
        $('.product-select .product-field').val($('.product-select :not(.hidden-select) select option[selected=selected]').val());
    });

    $('.add-history').click(function (e) {
        var prods_str = '';
        $('.product-select :not(.hidden-select) select option[selected=selected]').each(function (i) {
            if (prods_str != '') {
                prods_str = prods_str + '/' + $(this).val();
            } else {
                prods_str = $(this).val();
            }
        });
        $('.products_id').val(prods_str);
    });

    // Change status of an order on dropdown select
    $('.status-dropdown .dropdown-box button').click(function () {
        var order_id = $(this).data('id');
        var dropdown_toggle = $('#' + order_id);

        // Save variables
        var toggle_status = $(dropdown_toggle).data('status'),
            toggle_style = $(dropdown_toggle).data('style'),
            toggle_text = $(dropdown_toggle).text(),
            clicked_status = $(this).data('status'),
            clicked_style = $(this).data('style'),
            clicked_text = $(this).text();

        // Change clicked status on previously selected one
        $(this).removeClass('bg-theme-9');
        $(this).removeClass('bg-theme-12');
        $(this).removeClass('bg-theme-6');
        $(this).data('status', toggle_status);
        $(this).data('style', toggle_style);
        $(this).addClass(toggle_style);
        $(this).html(toggle_text);

        // Change active status button
        $(dropdown_toggle).removeClass('bg-theme-9');
        $(dropdown_toggle).removeClass('bg-theme-12');
        $(dropdown_toggle).removeClass('bg-theme-6');
        $(dropdown_toggle).data('status', clicked_status);
        $(dropdown_toggle).data('style', clicked_style);
        $(dropdown_toggle).addClass(clicked_style);
        var svg = '<svg class="w-4 h-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down w-4 h-4"><polyline points="6 9 12 15 18 9"></polyline></svg>';
        $(dropdown_toggle).html(clicked_text + svg);

        // Send Ajax to change it
        $.ajax({
            method: "POST",
            url: "/web/cities/daily-list",
            data: { order_id: order_id, status: $(dropdown_toggle).data('status') }
        })
            .done(function (msg) {
                //   alert( "Data Saved: " + msg );
            });
    });

    // Couriers buttons
    $('.delivered').click(function () {
        var this_el = $(this);
        if (confirm('Shu malumot yetkazildimi?')) {
            var id = $(this).data('id');
            $.ajax({
                method: "POST",
                url: "/web/courier/orders/index",
                data: { id: id, status: 'delivered' }
            })
                .done(function (msg) {
                    $(this_el).parents('.order-card').remove();
                    //   alert( "Data Saved: " + msg );
                });
        }
    });

    $('.canceled').click(function () {
        var this_el = $(this);
        if (confirm('Shu malumot qaytargarmi?')) {
            var id = $(this).data('id');
            $.ajax({
                method: "POST",
                url: "/web/courier/orders/index",
                data: { id: id, status: 'canceled' }
            })
                .done(function (msg) {
                    $(this_el).parents('.order-card').remove();
                    //   alert( "Data Saved: " + msg );
                });
        }
    });

    // BEGIN: FILTERS

    // Range filter (cities)
    $('span[data-filter]').hide();
    $('.monthly[data-filter=range]').show();
    $('.filter-range').change(function () {
        $('span[data-filter]').hide();
        $('.' + $(this).val() + '[data-filter=range]').show();
    });

    // Search filter (find what was given in data-element)
    $('.filter-search').bind('DOMAttrModified textInput input change keypress paste focus', function () {
        var val = $(this).val();
        var element = $(this).data('element');
        $('.' + element).hide();
        $('.' + element + ':containsi(' + val + ')').show();
    });

    // Search from dropdown with DB info
    $('.filter-dropdown-db').bind('DOMAttrModified textInput input change keypress paste focus', function () {
        var val = $(this).val();
        var element = $(this).data('element');
        if (val != 'all') {
            $('.' + element).hide();
            $('.' + element + ':containsi(' + val + ')').show();
        } else {
            $('.' + element).show();
        }
    });

    // END: FILTERS

    // Delete subject from database with view column
    $('.delete-subject').click(function (e) {
        e.preventDefault();
        if (confirm('Ushbu kurerni o\'chirmoqchimisiz?')) {
            var url = $(this).data('url');
            var id = $(this).data('id');
            var this_el = $(this).parents('.manager-row');
            $.ajax({
                method: "POST",
                url: url,
                data: { id: id },
                success: function(res) {
                    $(this_el).remove();
                }
            });
        }
    });


});


// Functions
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(input).parents('.image-upload').find('img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        $('.remove-photo').show();
    }
}

function load_js() {
    var head = document.getElementsByTagName('head')[0];
    var script = document.createElement('script');
    script.src = '/web/js/app.js';
    head.appendChild(script);
}

$.extend($.expr[':'], {
    'containsi': function(elem, i, match, array)
    {
      return (elem.textContent || elem.innerText || '').toLowerCase()
      .indexOf((match[3] || "").toLowerCase()) >= 0;
    }
});