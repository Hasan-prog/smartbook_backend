console.log('Loaded2')
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
    
    $('.dropdown-option').click(function () {
        $('.dropdown-option').removeClass('selected');
        $(this).addClass('selected');
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
    if ($('#edit_order').length === 0) {
        $('.overall').val($('.qty').prevAll('select').find('option[selected=selected]').data('price'));
    }

    // Change product strign product select
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
    $('.add-order').click(function (e) {
        e.preventDefault();
        $('.success').hide();
        $('.error').hide();

        // Collect phones and paste them into phone_number field
        var phone_number = '';
        $('.phones-group .flex input').each(function (i) {
            if (phone_number == '') {
                phone_number = $(this).val();
            } else {
                phone_number = phone_number + ',' + $(this).val();
            }
        });
        $('.phone-number').val(phone_number);

        $('.product-select .product-field').val($('.product-select :not(.hidden-select) select option[selected=selected]').val());

        var ajax_arr = {};
        var form_data = $(this).closest('form').serializeArray(),
            count_form_data = form_data.length,
            i = 0
            form = $(this).closest('form');
        form_data.forEach(field_data => {
            field_data['name'] = field_data['name'].replace('Orders','');
            field_data['name'] = field_data['name'].replace('[','');
            field_data['name'] = field_data['name'].replace(']','');

            if (field_data['value'] != '') {
                ajax_arr[field_data['name']] = field_data['value'];
            } else {
                if (field_data['name'] == '_csrf') {
                    ajax_arr[field_data['name']] = field_data['value'];
                } else {
                    // not all fields are filled
                    $('.error').slideDown('fast');
                    i = 0;
                }
            }

            i++;
        });
        console.log(ajax_arr);
        // Send Ajax to add order
        if (count_form_data == i) {
            $.ajax({
                method: "POST",
                url: "/orders/add-order",
                data: { orders: ajax_arr},
                success: function (res) {
                    $(form)[0].reset();
                    console.log(res);
                    $('.phones-group input[type="phone"]').not(":first").remove();
                    $('.overall').val($('.qty').prevAll('select').find('option[selected=selected]').data('price'));
                    $('.success').slideDown('fast');

                    // Clear personal inputs
                    $('#orders-client_id').val('');
                    $('#orders-name').val('');
                    $('.phones-group input[type="phone"]').val('998');
                    $('#orders-address').val('');
                },
                error: function (xml) {
                    console.log(xml);
                }
            });
        }
    });
    
    // alert(123);

        // Collect selects of products from add-order page and write it in the input
        $('.edit-order').click(function () {
            // Collect phones and paste them into phone_number field
            var phone_number = '';
            $('.phones-group .flex input').each(function (i) {
                if (phone_number == '') {
                    phone_number = $(this).val();
                } else {
                    phone_number = phone_number + ',' + $(this).val();
                }
            });
            $('.phone-number').val(phone_number);
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
        var clicked_option = $(this);
        var order_id = $(this).data('id');
        var dropdown_toggle = $('#' + order_id);
        var order_str = $(this).data('order-str');
        var courier_id = $(this).data('courier-id');
        var add_item = 0;
        
        // MAKE MANAGER CAN NOT SELECT YETKAZILMAGAN FROM YETKAZILGAN
        // if ($(this).data('status') != 'delivered') {
        //     var accounting_toggle = $('.dropdown-toggle' + '#' + $(this).data('id'));
        //     console.log(accounting_toggle);
        //     // Do it not transfered
        //     $(this).addClass('bg-theme-6');
        //     $(this).removeClass('bg-theme-9');
        //     $(this).data('accounting', 0);
        //     $(this).text('Berilmagan');
        //     if (parseInt($('.accounting-paid').text()) > 0) {
        //         $('.accounting-paid').text(parseInt($('.accounting-paid').text()) - price);
        //     }
        //     $('.accounting-debt').text(parseInt($('.accounting-debt').text()) + price);
        //     $('.accounting-debt-2').text($('.accounting-debt').text());

        //     var accounting = $(this).data('accounting');
        //     $.ajax({
        //         method: "POST",
        //         url: '/cities/daily-list',
        //         data: { order_id: order_id, accounting: accounting },
        //         success: function (res) {
        //             console.log(res);
        //         },
        //         error: function (xml) {
        //             console.log(xml);
        //         }
        //     });
        //     return;
        // }

        // Decrease from info collapse
        // if ($(dropdown_toggle).data('status') == 'delivered') {
        //     // Decrease info-delivered
        //     $('.info-delivered').text(parseInt($('.info-delivered').text()) - 1);
        //     // $('.info-delivered-header').text(parseInt($('.info-delivered-header').text()) - 1);
        //     var selected_status_info = $('.info-' + $(this).data('status'));
        //     $(selected_status_info).text(parseInt($(selected_status_info).text()) + 1);
        //     $('.accounting-debt').text(overall_delivered_price);
            
        // } 
        // if ($(dropdown_toggle).data('status') == 'not-delivered') {
        //     // Decrease info-not-delivered
        //     $('.info-not-delivered').text(parseInt($('.info-not-delivered').text()) - 1);
        //     // $('.info-not-delivered-header').text(parseInt($('.info-not-delivered-header').text()) - 1);
        //     var selected_status_info = $('.info-' + $(this).data('status'));
        //     $(selected_status_info).text(parseInt($(selected_status_info).text()) + 1);
        //     $('.accounting-debt').text(overall_delivered_price);
        // }
        // if ($(dropdown_toggle).data('status') == 'canceled') {
        //     // Decrease info-canceled
        //     $('.info-canceled').text(parseInt($('.info-canceled').text()) - 1);
        //     // $('.info-canceled-header').text(parseInt($('.info-canceled-header').text()) - 1);
        //     var selected_status_info = $('.info-' + $(this).data('status'));
        //     $(selected_status_info).text(parseInt($(selected_status_info).text()) + 1);
        //     $('.accounting-debt').text(overall_delivered_price);
        // }
        
        if ($(this).data('status') == 'not-delivered' && $(dropdown_toggle).data('status') != 'canceled') {
            if (confirm('Ushbu mahsulot uchun kuryerni qayta tiklashni xohlaysizmi? OK – bitta mahsulot orqaga qo\'shish, Cancel – qoshilmasdan')) {
                var add_item = 1;
            } else {
                var add_item = 0;
            }
        }
        if ($(dropdown_toggle).data('status') != 'not-delivered' && $(this).data('status') == 'canceled') {
            if (confirm('Ushbu mahsulot uchun kuryerni qayta tiklashni xohlaysizmi? OK – bitta mahsulot orqaga qo\'shish, Cancel – qoshilmasdan')) {
                var add_item = 1;
            } else {
                var add_item = 0;
            }
        }

        // Add a new dept to accounting, because an order was delivered
        if ($(this).data('status') == 'delivered') {
            if ($('.accounting-toggle[data-id="' + $(this).data('id') + '"]').data('accounting') == 0) {
                $('.accounting-debt').text(parseInt($('.accounting-debt').text()) + $(this).data('price'));
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

        var overall_delivered_price = 0;
        $('.status-dropdown .dropdown-toggle').each(function () {
            if ($(this).data('status') == 'delivered' && $(this).data('accounting') == 0) {
                overall_delivered_price += $(this).data('price');
            }
        });

        // Decrease from info collapse
        if ($(dropdown_toggle).data('status') == 'delivered') {
            // Decrease info-delivered
            $('.info-delivered').text(parseInt($('.info-delivered').text()) - 1);
            // $('.info-delivered-header').text(parseInt($('.info-delivered-header').text()) - 1);
            var selected_status_info = $('.info-' + $(this).data('status'));
            $(selected_status_info).text(parseInt($(selected_status_info).text()) + 1);
            $('.accounting-debt').text(overall_delivered_price);
            
        } 
        if ($(dropdown_toggle).data('status') == 'not-delivered') {
            // Decrease info-not-delivered
            $('.info-not-delivered').text(parseInt($('.info-not-delivered').text()) - 1);
            // $('.info-not-delivered-header').text(parseInt($('.info-not-delivered-header').text()) - 1);
            var selected_status_info = $('.info-' + $(this).data('status'));
            $(selected_status_info).text(parseInt($(selected_status_info).text()) + 1);
            $('.accounting-debt').text(overall_delivered_price);
        }
        if ($(dropdown_toggle).data('status') == 'canceled') {
            // Decrease info-canceled
            $('.info-canceled').text(parseInt($('.info-canceled').text()) - 1);
            // $('.info-canceled-header').text(parseInt($('.info-canceled-header').text()) - 1);
            var selected_status_info = $('.info-' + $(this).data('status'));
            $(selected_status_info).text(parseInt($(selected_status_info).text()) + 1);
            $('.accounting-debt').text(overall_delivered_price);
        }

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
                order_str = $(this).data('order-str'),
                district_id = $(this).data('district');
            $.ajax({
                method: "POST",
                url: "/courier/orders/index",
                data: { id: id, status: 'delivered', comment: comment, courier_id: courier_id, order_str: order_str },
                success: function (res) {
                    // If this card was last in this day, then remove hedaer
                    if ($(this_el).closest('.day-list').find('.box').length <= 1) {
                        $(this_el).closest('.day-list').remove();
                    }

                    // Remove order card
                    $(this_el).parents('.order-card').remove();

                    // Decrease qty of a district
                    $('.districts-list .list-option[data-id=' + district_id + '] .qty').text($('.districts-list .list-option[data-id=' + district_id + '] .qty').text() - 1);
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
                order_str = $(this).data('order-str'),
                district_id = $(this).data('district');
            $.ajax({
                method: "POST",
                url: "/courier/orders/",
                data: { id: id, status: 'canceled', comment: comment, courier_id: courier_id, order_str: order_str },
                success: function () {
                    $(this_el).parents('.order-card').remove();

                    // Decrease qty of a district
                    $('.districts-list .list-option[data-id=' + district_id + '] .qty').text($('.districts-list .list-option[data-id=' + district_id + '] .qty').text() - 1);
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

    // Search filter (find what was given in data-element)
    $('.filter-search-pagination').bind('DOMAttrModified textInput input change keypress paste focus', function () {        
        // if there is a pagination, hide it
        $('.pagination').hide();
        var val = $(this).val();
        var element = $(this).data('element');
        if ($('.filter-search-pagination').val() == '') {
            $('.pagination').show();
            $('.' + element).removeClass('important-hide');
            $('.' + element).removeClass('important-show');
        } else {
            $('.' + element).removeClass('important-show');
            $('.' + element).addClass('important-hide');
            $('.' + element + ':containsi(' + val + ')').removeClass('important-hide');
            $('.' + element + ':containsi(' + val + ')').addClass('important-show');
        }
    });

    // Search from dropdown with DB info
    // $('.filter-dropdown-db').bind('DOMAttrModified textInput input change keypress paste focus', function () {
    //     var val = $(this).val();
    //     var element = $(this).data('element');
    //     if (val != 'all') {
    //         $('.' + element).hide();
    //         $('.' + element + ':containsi(' + val + ')').show();
    //     } else {
    //         $('.' + element).show();
    //     }
    // });

    // Logic for js pagination
    $('.page__button').click(function () {
        // Return false if user taps on active button
        if ($(this).hasClass('pagination__link--active')) {
            return;
        }

        // Showing selected page clients
        var element = $(this).data('element'),
            page_i = $(this).data('page');

        $('.page__button').removeClass('pagination__link--active');
        $(this).addClass('pagination__link--active');
        $('.' + element).hide();
        $('.' + element).addClass('hidden');
        $('.' + element + '[data-page="' + page_i + '"]').show();
        $('.' + element + '[data-page="' + page_i + '"]').removeClass('hidden');
    });
    // Clicking arrows in a pagination
    $('.pagination_arrow').click(function () {
        var element = $(this).data('element'),
            action = $(this).data('action'),
            pages_qty = $(this).data('pages') - 1;

        // Select current page
        var current_page = $('.' + element + ':not(.hidden)').data('page');

        // Do the action
        if (action == 'prev') {
            if (current_page > 1) {
                current_page--;
            } else {
                return;
            }
        }
        if (action == 'next') {
            if (current_page < pages_qty) {
                current_page++;
            } else {
                return;
            }
        }
        
        $('.page__button').removeClass('pagination__link--active');
        $('.page__button[data-page="' + current_page + '"]').addClass('pagination__link--active');
        $('.' + element).hide();
        $('.' + element).addClass('hidden');
        $('.' + element + '[data-page="' + current_page + '"]').show();
        $('.' + element + '[data-page="' + current_page + '"]').removeClass('hidden');
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
                data: { id: id, delete: 1 },
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
        var price = $(this).data('price');

        // Before check tha product is yetkazilgan
        if ($(this).prev().find('.dropdown-toggle').data('status') != 'delivered') {
            alert('Shu buyurtma hali yetkazilmagan 😁');
            return;
        }

        if (accounting == 0) {
            // Do it transfered
            $(this).removeClass('bg-theme-6');
            $(this).addClass('bg-theme-9');
            $(this).data('accounting', 1);
            console.log($('.accounting-debt').text());
            if (parseInt($('.accounting-debt').text()) > 0) {
                $('.accounting-debt').text(parseInt($('.accounting-debt').text()) - price);
            }
            $('.accounting-paid').text(parseInt($('.accounting-paid').text()) + price);
            $('.accounting-debt-2').text($('.accounting-debt').text());
            $(this).text('Berilgan');
        } else {
            // Do it not transfered
            $(this).addClass('bg-theme-6');
            $(this).removeClass('bg-theme-9');
            $(this).data('accounting', 0);
            $(this).text('Berilmagan');
            if (parseInt($('.accounting-paid').text()) > 0) {
                $('.accounting-paid').text(parseInt($('.accounting-paid').text()) - price);
            }
            $('.accounting-debt').text(parseInt($('.accounting-debt').text()) + price);
            $('.accounting-debt-2').text($('.accounting-debt').text());
        }
        var accounting = $(this).data('accounting');
        $.ajax({
            method: "POST",
            url: '/cities/daily-list',
            data: { order_id: order_id, accounting: accounting },
            success: function (res) {
                console.log(res);
            },
            error: function (xml) {
                console.log(xml);
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
    $('.city-select').change(function () {
        showCouriers($(this));
    });
    showCourierByDistrtict($('.district-select').val());
    $('.district-select').change(function () {
        showCouriersByDistrict($('.city-select'), this.options[this.selectedIndex]);
    });
// alert(1234);
    function showCourierByDistrtict(dstr_id) {
        var selected_city = $('.city-select').val();
        // var dstr_id = $(this).val();
        $('.courier-select option[data-city="' + selected_city + '"]').each(function () {
            // All coureirs in each are from the selected CITY
            if (isNaN($(this).data('districts'))) {
                var dstr_arr = $(this).data('districts').split(',');
            }
            var dstr_arr = $(this).data('districts');
            $(this).attr('selected', 'selected');
            $('.courier-select .dropdown-option').removeAttr('selected');
            if (isNaN($(this).data('districts'))) {
                if (dstr_arr.includes(dstr_id)) {
                    // This courier is from the selected DISTRICT
                    $(this).show();
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').show();
                    $(this).attr('selected', 'selected');
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').attr('selected', 'selected');
    
                    // Change label-inner and make this option active
                    $('.courier-select .label-inner').text($(this).text());
                } else {
                    // This courier is NOT from the selected DISTRICT
                    $(this).hide();
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').hide();
                    $(this).removeAttr('selected');
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').removeAttr('selected');
                }
            } else {
                    if (dstr_arr == dstr_id) {
                    // This courier is from the selected DISTRICT
                    $(this).show();
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').show();
                    $(this).attr('selected', 'selected');
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').attr('selected', 'selected');
    
                    // Change label-inner and make this option active
                    $('.courier-select .label-inner').text($(this).text());
                } else {
                    // This courier is NOT from the selected DISTRICT
                    $(this).hide();
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').hide();
                    $(this).removeAttr('selected');
                    $('.courier-select .dropdown-option[data-key="' + $(this).val() + '"]').removeAttr('selected');
                }
            }
        });
    }

    // Remove select class (active bg) from tail-select option
    $('.dropdown-option').click(function () {
        $(this).parent().find('.dropdown-option').removeClass('selected');
        $(this).addClass('selected');
    });

    // Change districts by selecting city
    $('.city-select').change(function () {
        showDistricts($(this).val());
        
        // Change inner label
        var label = $('.district-select option[data-city="' + $(this).val() + '"]')[0];
        if (label != undefined) {
            $(label).show();
            $('.district-select option').removeAttr('selected');
            $(label).attr('selected', 'selected');
            $('.district-select .label-inner').text($(label).text());
        } else {
            $('.district-select .label-inner').text('Hamma tumanlar...');
        }
    });

    showDistricts($('.city-select').val());

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
                    $(this).removeAttr('selected');
                    // $('.district-select .dropdown-option').removeAttr('selected');
                    // $('.district-select .dropdown-option').removeClass('selected');
                    // $(this).addClass('selected');
                } else {
                    // hide this option
                    $(this).hide();
                    $(this).removeAttr('selected');
                }
            });
        }
    }

    // Show a certain district's orders
    $('.districts-list .list-option').click(function () {
        $('.districts-list .list-option svg').hide();
        $(this).find('svg').css({'display': 'inline'}).show();
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

    // Show all orders from all districts
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

    // Remove certain item completely from courier's qty_left
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
    });

    // Make clicked select inpur z-index top to avoid overlayering by other fields
    $('.tail-select').click(function () {
        $('.tail-select').closest('.col-span-12').css({
            'z-index': '1',
        });
        $(this).closest('.col-span-12').css({
            'z-index': '50',
        });
    });

    // Choose month filter, just move it top
    $('.move-month').change(function () {
        var id = $(this).find('option:selected').data('id');
        var month = $('#' + id);
        $('#' + id).remove();
        $('.filters').after(month);
    });

    // Add masks to all phones fields
    $(":input").inputmask();
    $('input[type=phone]').inputmask({"mask": "+999 99 999 99 99"});
    // Add new phone field
    $('.add-new-phone').click(function () {
        $(this).before('<input type="phone" class="input w-full border qty" value="+998">');
        $(":input").inputmask();
        $('input[type=phone]').inputmask({"mask": "+999 99 999 99 99"});
    });

    // Simulate click on selected districts
    $('#new_courier .city-district-select option[data-selected="1"]').each(function () {
        $('.district-select .dropdown-option[data-key="' + $(this).val() + '"]').click();
    });

    // Collapse accounting info
    $('.collapse-accounting-info').click(function () {
        if ($('.accounting-info').is(':visible')) {
            $('.accounting-info').slideUp('fast');
        } else {
            $('.accounting-info').slideDown('fast');
        }
    });

    // Select attached a courier's equipments in edit-courier
    $('.courier-equipment option[data-selected="1"]').each(function () {
        $('.courier-equipment .dropdown-option[data-key="' + $(this).val() + '"]').click();
    });

    $('.city-select').change(function () {
        $(this).parent().find('.district-select').find('.select-handle').each(function () {
            $(this).click();
        });
    });

    // $('.filter-city').change(function () {
    //     var element = $(this).data('element');
    //     var select = $(this);
    //     $('.' + element).each(function () {
    //         console.log($(this).data('city'));
    //         if ($(this).data('city') == $(select).val()) {
    //             $(this).show();
    //         } else {
    //             $(this).hide();
    //         }
    //     });
    // });

    // Opening note section in orders cards
    $('.open-note').click(function () {
        var note = $(this).closest('.order-card').find('.card-note');
        $(note).removeClass('hidden');
        $(note).find('input').focus();
    });

    $('.card-note input').focusout(function () {
        if ($(this).val() != '') {
            var comment = $(this).val(),
                order_id = $(this).data('id');
        } else {
            var comment = '',
                order_id = $(this).data('id');
        }

        // Send a new comment for the order via Ajax 
        $.ajax({
            method: "POST",
            url: '/courier/orders/index',
            data: { id: order_id, comment: comment, note: true },
            success: function (res) {
                console.log(res);
            },
            error: function (xml) {
                console.log(xml);
            }
        });
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
    'containsi': function (elem, i, match, array) {
        return (elem.textContent || elem.innerText || '').toLowerCase()
            .indexOf((match[3] || "").toLowerCase()) >= 0;
    }
});

$('#new_order .district-select-order .label-inner').text('Hamma tumanlar...');


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


showCouriers($('.city-select'));

function showCouriers(city_select) {
    
    // $('.courier-select .dropdown-optgroup .dropdown-option').removeClass('selected');
    var city_id = $(city_select).find('option[selected]').data('id');
    var isset = 0;
    $('.courier-select option').each(function (i) {
        if ($(this).data('city') == city_id) {
            isset = 1;
            $(this).show();
            $('.courier-select option').removeAttr('selected');
            $(this).attr('selected', 'selected');
            var option = $(this);
            $('.courier-select .dropdown-optgroup .dropdown-option').each(function (i) {
                if ($(this).text() == $(option).text()) {
                    $(this).show();
                    if (i == 0) {
                        $(this).attr('selected', 'selected');
                        $(this).addClass('selected');
                    }
                    $('.courier-select .label-inner').text($(this).text());
                }
            });
        } else {
            // A courier is not from that city
            $(this).hide();
            var option = $(this);
            $(this).removeAttr('selected');
            $(this).removeClass('selected');
            $('.courier-select .dropdown-optgroup .dropdown-option').each(function () {
                if ($(this).text() == $(option).text()) {
                    $(this).removeClass('selected');
                    $(this).hide();
                }
            });
        }
    });
    if (isset == 0) {
        $('.courier-select .label-inner').text('Shu shaharda kuryerlar topilmadi');
    }
}

function showCouriersByDistrict(city_select, clicked_dstr) {
    
    // $('.courier-select .dropdown-optgroup .dropdown-option').removeClass('selected');
    var city_id = $(city_select).find('option[selected]').data('id');
    var district_id = $(clicked_dstr).data('id');
    var isset = 0;

    $('.courier-select option').each(function (i) {
        console.log($(this).data('districts'));
console.log($(clicked_dstr).val())
        if ($(this).data('city') == city_id && $(this).data('districts').includes($(clicked_dstr).val())) {
            isset = 1;
            $(this).show();
            $('.courier-select option').removeAttr('selected');
            $(this).attr('selected', 'selected');
            var option = $(this);
            $('.courier-select .dropdown-optgroup .dropdown-option').each(function (i) {
                if ($(this).text() == $(option).text()) {
                    $(this).show();
                    if (i == 0) {
                        $(this).attr('selected', 'selected');
                        $(this).addClass('selected');
                    }
                    $('.courier-select .label-inner').text($(this).text());
                }
            });
        } else {
            // A courier is not from that city
            $(this).hide();
            var option = $(this);
            $(this).removeAttr('selected');
            $(this).removeClass('selected');
            $('.courier-select .dropdown-optgroup .dropdown-option').each(function () {
                if ($(this).text() == $(option).text()) {
                    $(this).removeClass('selected');
                    $(this).hide();
                }
            });
        }
    });
    if (isset == 0) {
        $('.courier-select .label-inner').text('Shu shaharda kuryerlar topilmadi');
    }
}