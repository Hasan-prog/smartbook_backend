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

    $('#new_order input:not(#orders-price):not(.qty)').val('');
    $('.select-handle').click();
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
        $(select_el).attr('value', $(select_el).data('id') + ',' + $(select_el).data('name') + ',' + $(select_el).data('format') + ':' + qty);
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
        var order_str = $(this).data('order-str');
        var courier_id = $(this).data('courier-id');
        var add_item = 0;
        
        if ($(this).data('status') == 'not-delivered' || $(this).data('status') == 'canceled') {
            if (confirm('Shu mahsulatni kuryer qogan mahsulotlarga qoshish keremi?')) {
                var add_item = 1;
            } else {
                var add_item = 0;
            }
        }

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
            url: "/cities/daily-list",
            data: { order_id: order_id, status: $(dropdown_toggle).data('status'), order_str: order_str, courier_id: courier_id, add_item: add_item },
            success: function (res) {
                console.log(res);
            },
            error: function (xml) {
                console.log(xml);
            }
        })
            .done(function (msg) {
                //   alert( "Data Saved: " + msg );
            });
    });

    // Couriers buttons
    $('.delivered').click(function () {
        var this_el = $(this);
        var comment = window.prompt('Shu malumot yetkazildimi? Holasez sharhni yozishiz boladi.');
        if (comment != null) {
            var id = $(this).data('id'),
                courier_id = $(this).data('courier'),
                order_str = $(this).data('order-str');
            $.ajax({
                method: "POST",
                url: "/courier/orders/index",
                data: { id: id, status: 'delivered', comment: comment, courier_id: courier_id, order_str: order_str },
                success: function (res) {
                    console.log(res);
                    // If this card was last in this day, then remove hedaer
                    if ($(this_el).closest('.day-list').find('.box').length <= 1) {
                        $(this_el).closest('.day-list').remove();
                    }

                    // Remove order card
                    $(this_el).parents('.order-card').remove();
                }
            })
                .done(function (msg) {
                    //   alert( "Data Saved: " + msg );
                });
        }
    });

    $('.canceled').click(function () {
        var this_el = $(this);
        var comment = window.prompt("Nima uchun kitob qaytarildi? Komment yozing.");
        if (comment != null) {
            var id = $(this).data('id'),
                courier_id = $(this).data('courier'),
                order_str = $(this).data('order-str');
            $.ajax({
                method: "POST",
                url: "/courier/orders/",
                data: { id: id, status: 'canceled', comment: comment, courier_id: courier_id, order_str: order_str },
                success: function () {
                    $(this_el).parents('.order-card').remove();
                }
            })
                .done(function (msg) {
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
        if (confirm($(this).data('msg'))) {
            var url = $(this).data('url');
            var id = $(this).data('id');
            var this_el = $(this).parents('.' + $(this).data('parent'));
            $.ajax({
                method: "POST",
                url: url,
                data: { id: id },
                success: function (res) {
                    console.log(res);
                    $(this_el).remove();
                }
            });
        }
    });

    // Show managers or admins login form
    $('.managers-form-toggle').click(function () {
        $('.login-form').hide();
        $('.managers-form').show();
        $('.form-toggle').addClass('bg-gray-200');
        $('.form-toggle').removeClass('bg-theme-1 text-white');
        $(this).removeClass('bg-gray-200');
        $(this).addClass('bg-theme-1 text-white');
    });
    $('.admins-form-toggle').click(function () {
        $('.login-form').hide();
        $('.admins-form').show();
        $('.form-toggle').addClass('bg-gray-200');
        $('.form-toggle').removeClass('bg-theme-1 text-white');
        $(this).removeClass('bg-gray-200');
        $(this).addClass('bg-theme-1 text-white');
    });
    $('.courier-form-toggle').click(function () {
        $('.login-form').hide();
        $('.courier-form').show();
        $('.form-toggle').addClass('bg-gray-200');
        $('.form-toggle').removeClass('bg-theme-1 text-white');
        $(this).removeClass('bg-gray-200');
        $(this).addClass('bg-theme-1 text-white');
    });

    // Change accounting on click
    $('.accounting-toggle').click(function () {
        var order_id = $(this).data('id');
        var accounting = $(this).data('accounting');
        if (accounting == 0) {
            // Do it transfered
            $(this).removeClass('bg-theme-6');
            $(this).addClass('bg-theme-9');
            $(this).data('accounting', 1);
            $(this).text('Berilgan');
        } else {
            // Do it not transfered
            $(this).addClass('bg-theme-6');
            $(this).removeClass('bg-theme-9');
            $(this).data('accounting', 0);
            $(this).text('Berilmagan');
        }
        var accounting = $(this).data('accounting');
        $.ajax({
            method: "POST",
            url: '/cities/daily-list',
            data: { id: order_id, accounting: accounting },
            success: function (res) {
                console.log(res);
            }
        });
        return;
    });

    // Get the day
    var day = document.getElementById('1');
    next_header_offset = 0;

    // When the user scrolls the page, execute headersTrigger 
    if ($(day).find('.order-card').length > 0) {
        window.onscroll = function () { headersTrigger() };
    }

    // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function headersTrigger() {
        // Get the day's props
        var orders = day.getElementsByClassName('order-card'),
            last_order = orders[orders.length - 1],
            first_order = orders[0],
            last_order_offset = last_order.offsetTop + last_order.clientHeight,
            first_order_offset = first_order.offsetTop;

        // Get the header
        var header = day.querySelector('.orders-list-header');

        // Get the offset position of the navbar
        var sticky = header.offsetTop;

        var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop
        if (window.innerWidth <= 480) {
            if (window.pageYOffset < 72) {
                header.classList.remove("sticky");
                document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                return;
            }
            if (window.pageYOffset > sticky && scrollTop < last_order_offset + 16) {
                header.classList.add("sticky");
                document.querySelector('.all-orders .order-card').classList.add("m-48px");
                if (scrollTop + 48 < next_header_offset && parseInt(day.id) > 1) {
                    var prev_day_id = parseInt(day.id) - 1;
                    var prev_day = document.getElementById('' + prev_day_id + '');
                    header.classList.remove("sticky");
                    // document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                    day = prev_day;
                }
            } else {
                if (scrollTop > last_order_offset + 48) {
                    var next_day_id = parseInt(day.id) + 1;
                    var next_day = document.getElementById('' + next_day_id + '');
                    header.classList.remove("sticky");
                    document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                    next_header_offset = next_day.querySelector('.orders-list-header').offsetTop;
                    day = next_day;
                }
                header.classList.remove("sticky");
                document.querySelector('.all-orders .order-card').classList.remove("m-48px");
            }
        } else {
            if (window.pageYOffset < 111) {
                header.classList.remove("sticky");
                document.querySelector('.all-orders .order-card').classList.remove("m-69px");
                return;
            }
            if (window.pageYOffset > sticky && scrollTop < last_order_offset + 16) {
                header.classList.add("sticky");
                document.querySelector('.all-orders .order-card').classList.add("m-69px");
                if (scrollTop + 69 < next_header_offset && parseInt(day.id) > 1) {
                    var prev_day_id = parseInt(day.id) - 1;
                    var prev_day = document.getElementById('' + prev_day_id + '');
                    header.classList.remove("sticky");
                    // document.querySelector('.all-orders .order-card').classList.remove("m-69px");
                    day = prev_day;
                }
            } else {
                if (scrollTop > last_order_offset + 69) {
                    var next_day_id = parseInt(day.id) + 1;
                    var next_day = document.getElementById('' + next_day_id + '');
                    header.classList.remove("sticky");
                    document.querySelector('.all-orders .order-card').classList.remove("m-48px");
                    next_header_offset = next_day.querySelector('.orders-list-header').offsetTop;
                    day = next_day;
                }
                header.classList.remove("sticky");
                document.querySelector('.all-orders .order-card').classList.remove("m-69px");
            }
        }
    }

    $('.rows-header .collapse-table').click(function () {
        var table = $(this).parent().next('#striped-rows-table');
        
        if ($(table).data('collapse') == 0) {
            $(table).slideUp('fast');
            $(table).data('collapse', 1);
            $(this).find('svg').remove();
            $(this).find('span').html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize-2 w-5 h-5"><polyline points="15 3 21 3 21 9"></polyline><polyline points="9 21 3 21 3 15"></polyline><line x1="21" y1="3" x2="14" y2="10"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>');
        } else {
            $(table).slideDown('fast');
            $(table).data('collapse', 0);
            $(this).find('svg').remove();
            $(this).find('span').html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-minimize-2 w-5 h-5"><polyline points="4 14 10 14 10 20"></polyline><polyline points="20 10 14 10 14 4"></polyline><line x1="14" y1="10" x2="21" y2="3"></line><line x1="3" y1="21" x2="10" y2="14"></line></svg>');
        }
    });

    $('.month-sort-filter').change(function () {
        var table = $(this).parents('#striped-rows-table');
        $(table).find('.day-row').each(function (i) {
            $(table).find('tbody').prepend($(this));
        });
    });

    // Sort couriers when select a certain city
    showCouriers($('.city-select'));
    $('.city-select').change(function () {
        showCouriers($(this));
    });

    function showCouriers(city_select) {
        $('.dropdown-optgroup .dropdown-option').removeClass('selected');
        var city_id = $(city_select).find('option[selected]').data('id');
        $('.courier-select option').each(function (i) {
            if ($(this).data('city') == city_id) {
                $(this).attr('selected', 'selected');
                $('.courier-select .label-inner').text($(this).text());
                $('.dropdown-optgroup .dropdown-option').removeClass('selected');
                $('.dropdown-optgroup .dropdown-option').each(function () {
                    if ($(this).text() == $('.courier-select .label-inner').text()) {
                        $(this).addClass('selected');
                    }
                })
                return false;
            } else {
                $(this).removeAttr('selected');
            }
        });
    }

    // Change districts by selecting city
    $('.city-select').change(function () {
        showDistricts($(this).val());
    });

    showDistricts($('.city-select option[selected]').val());

    function showDistricts(city_id) {
        var dstr_arr = [];
        var selected_dstr_arr = [];
        $('.district-select option').each(function (i) {
            $(this).removeAttr('selected');
            if ($(this).data('city') != city_id) {
                $(this).hide();
            } else {
                str = $(this).text().replace(/\s+/g,' ').trim();
                dstr_arr.push(str);
            }
        });

        if (dstr_arr != []) {
            $('.district-select option').closest('select').next().find('.dropdown-option').each(function (i) {
                if (dstr_arr.includes($(this).text())) {
                    // leave this option
                    $(this).show();
                } else {
                    // hide this option
                    $(this).hide();
                }
            });
        }
    }

    // Show a certain district's orders
    $('.districts-list .list-option').click(function () {
        var dstr_id = $(this).data('id');
        $('.collapse-districts').text($(this).data('name'));
        $('.order-card').each(function (i) {
            if ($(this).data('district') != dstr_id) {
                $(this).hide();
            } else {
                $(this).show();
                $(this).closest('.day-list').show();
            }
            if ($(this).closest('.day-list').find('.order-card:visible').length == 0) {
                $(this).closest('.day-list').hide();
            }
        });
    });

    $('.select-district .others').click(function () {
        $('.order-card').each(function (i) {
            $(this).show();
            $(this).closest('.day-list').show();
        });
        $('.collapse-districts').text('Manzilni tanlang');
    });

    $('.change-qty_left .qty').change(function () {
        var str = '';
        $('.change-qty_left .item').each(function (i) {
            if (str == '' && $(this).data('show') == true) {
                str = $(this).find('.info').data('str-info') + ':' + $(this).find('.qty').val();
            } else {
                str = str + '/' + $(this).find('.info').data('str-info') + ':' + $(this).find('.qty').val();
            }
        });

        $('.items-left-str').val(str);
        
    });

    $('.change-qty_left .remove-product-select').click(function () {
        $(this).parent('.item').remove();

        var str = '';
        $('.change-qty_left .item').each(function (i) {
            if (str == '' && $(this).data('show') == true) {
                str = $(this).find('.info').data('str-info') + ':' + $(this).find('.qty').val();
            } else {
                str = str + '/' + $(this).find('.info').data('str-info') + ':' + $(this).find('.qty').val();
            }
        });

        $('.items-left-str').val(str);
    })

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
    'containsi': function (elem, i, match, array) {
        return (elem.textContent || elem.innerText || '').toLowerCase()
            .indexOf((match[3] || "").toLowerCase()) >= 0;
    }
});

$('.district-select-order .label-inner').text('Hamma tumanlar...');


// Collapse districts
$('.collapse-districts').click(function () {
    if ($(this).data('collapse') == 'opened') {
        $('.districts-list').slideUp(100);
        $(this).data('collapse', 'closed');
    } else {
        $('.districts-list').slideDown(100);
        $(this).data('collapse', 'opened');
    }
});
