import("lib/jquery/jquery.min.js");
import("lib/jquery/jquery-migrate.min.js");

$(document).keydown(function(e) {
    // ESCAPE key pressed
    if (e.keyCode == 27) {
        formClear();
    }
});

$(function () {
    $('#obc_title').load('common/title.php');
    $('#home_button').load('common/home.html');
    $('#common_part').load('common/modal.html');
});

if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

jQuery(function ($) {

    $('#bookmark-this').click(function (e) {
        var bookmarkTitle = document.title;
        var bookmarkUrl = window.location.href;

        if ('addToHomescreen' in window && addToHomescreen.isCompatible) {
            // Mobile browsers
            addToHomescreen({ autostart: false, startDelay: 0 }).show(true);
        } else if (/CriOS\//.test(navigator.userAgent)) {
            // Chrome for iOS
            alert('To add to Home Screen, launch this website in Safari, then tap the Share button and select "Add to Home Screen".');
        } else if (window.sidebar && window.sidebar.addPanel) {
            // Firefox <=22
            window.sidebar.addPanel(bookmarkTitle, bookmarkUrl, '');
        } else if ((window.sidebar && /Firefox/i.test(navigator.userAgent) && !Object.fromEntries) || (window.opera && window.print)) {
            // Firefox 23-62 and Opera <=14
            $(this).attr({
                href: bookmarkUrl,
                title: bookmarkTitle,
                rel: 'sidebar'
            }).off(e);
            return true;
        } else if (window.external && ('AddFavorite' in window.external)) {
            // IE Favorites
            window.external.AddFavorite(bookmarkUrl, bookmarkTitle);
        } else {
            // Other browsers (Chrome, Safari, Firefox 63+, Opera 15+)
            alert('Press ' + (/Mac/i.test(navigator.platform) ? 'Cmd' : 'Ctrl') + '+D to bookmark this page.');
        }

        return false;
    });

});

var datalist = {
    month_list:
        '<option value="1月份"></option>' +
        '<option value="2月份"></option>' +
        '<option value="3月份"></option>' +
        '<option value="4月份"></option>' +
        '<option value="5月份"></option>' +
        '<option value="6月份"></option>' +
        '<option value="7月份"></option>' +
        '<option value="8月份"></option>' +
        '<option value="9月份"></option>' +
        '<option value="10月份"></option>' +
        '<option value="11月份"></option>' +
        '<option value="12月份"></option>',
    item_list:
        '<option value="4绿碗"></option>' +
        '<option value="5绿碗"></option>' +
        '<option value="7绿碗"></option>' +
        '<option value="3.5汤"></option>' +
        '<option value="5圆汤"></option>' +
        '<option value="6圆汤"></option>' +
        '<option value="7圆汤"></option>' +
        '<option value="8圆平"></option>' +
        '<option value="9圆平"></option>' +
        '<option value="11圆平"></option>' +
        '<option value="7正平"></option>' +
        '<option value="9正平"></option>' +
        '<option value="11正平"></option>' +
        '<option value="方鱼盘"></option>' +
        '<option value="4天龙碗"></option>' +
        '<option value="5天龙碗"></option>' +
        '<option value="7天龙碗"></option>' +
        '<option value="2P杯碟"></option>' +
        '<option value="5P杯碟"></option>' +
        '<option value="2P皇室杯"></option>' +
        '<option value="5P皇室杯"></option>' +
        '<option value="22p"></option>' +
        '<option value="6格碟"></option>' +
        '<option value="4绿碗外箱"></option>' +
        '<option value="5绿碗外箱"></option>' +
        '<option value="7绿碗外箱"></option>' +
        '<option value="3.5汤外箱"></option>' +
        '<option value="5圆汤外箱"></option>' +
        '<option value="6圆汤外箱"></option>' +
        '<option value="7圆汤外箱"></option>' +
        '<option value="8圆平外箱"></option>' +
        '<option value="9圆平外箱"></option>' +
        '<option value="11圆平外箱"></option>' +
        '<option value="7正平外箱"></option>' +
        '<option value="9正平外箱"></option>' +
        '<option value="11正平外箱"></option>' +
        '<option value="方鱼盘外箱"></option>' +
        '<option value="4天龙碗外箱"></option>' +
        '<option value="5天龙碗外箱"></option>' +
        '<option value="7天龙碗外箱"></option>' +
        '<option value="2P杯碟外箱"></option>' +
        '<option value="5P杯碟外箱"></option>' +
        '<option value="2P皇室杯外箱"></option>' +
        '<option value="5P皇室杯外箱"></option>' +
        '<option value="22p外箱"></option>' +
        '<option value="6格碟外箱"></option>',
    worker_list:
        '<option value="付秀丽">' +
        '<option value="何删">',
    // class_list:
    //     '<option value="白瓷"></option>' +
    //     '<option value="花纸"></option>' +
    //     '<option value="完成品"></option>' +
    //     '<option value="包装物"></option>' +
    //     '<option value="彩瓷"></option>' +
    //     '<option value="出库"></option>' +
    //     '<option value="贴花"></option>' +
    //     '<option value="彩盒"></option>'
};

var showing = {
    material: {
        no:         'none',
        date:       'show',
        supplier:   'none',
        item:       'show',
        design:     'show',
        qty:        'show',
        month:      'none',
        class:      'show',
        worker:     'none',
        edit:       'show',
        del:        'show'
    },
    stock: {
        no:         'none',
        item:       'show',
        design:     'show',
        qty:        'show',
        class:      'show',
        edit:       'show',
        del:        'show'
    },
    custom: {
        no:         'none',
        date:       'none',
        customer:   'show',
        item:       'show',
        design:     'show',
        qty:        'show',
        orderno:    'show',
        edit:       'show',
        del:        'show',
    },
    ordering: {
        no:         'none',
        date:       'show',
        supplier:   'show',
        item:       'show',
        design:     'show',
        qty:        'show',
        orderno:    'show',
        class:      'show',
        edit:       'show',
        del:        'show'
    },
    payment: {
        no:         'none',
        date:       'show',
        item:       'show',
        design:     'show',
        class:      'show',
        qty:        'show',
        price:      'show',
        total:      'show',
    },
    price: {
        no:         'none',
        supplier:   'show',
        item:       'show',
        design:     'show',
        price:      'show',
        class:      'show',
        edit:       'show',
        del:        'show'
    },
    shipping: {
        no:         'none',
        supplier:   'none',
        item:       'show',
        design:     'show',
        class:      'show',
        rate:       'show',
        price:      'show',
        worker:     'none',
        edit:       'show',
        del:        'show'
    },
    order: {
        item:       'show',
        design:     'show',
        qty:        'show',
        baici:      'show',
        huazhi:     'show',
        chengpin:   'show',
        order:      'show'
    }
};

for (var key in datalist) {
    var elem = document.getElementById(key);
    if (elem != null) {
        elem.innerHTML = datalist[key];
    }
}

var elem = document.getElementById("customer_list");
if (elem != null) {
    var ctl = elem.parentElement.children.item(0).children.namedItem('customer');
    submit_basic(ctl);
}

var elem = document.getElementById("supplier_list");
if (elem != null) {
    var ctl = elem.parentElement.children.item(0).children.namedItem('supplier');
    submit_basic(ctl);
}

var elem = document.getElementById("design_list");
if (elem != null) {
    var ctl = elem.parentElement.children.item(0).children.namedItem('design');
    submit_basic(ctl);
}

var elem = document.getElementById("orderno_list");
if (elem != null) {
    var ctl = elem.parentElement.children.item(0).children.namedItem('orderno');
    submit_basic(ctl);
}

var elem = document.getElementById("class_list");
if (elem != null) {
    var ctl = elem.parentElement.children.item(0).children.namedItem('class');
    submit_basic(ctl);
}

function getData(ctl) {
    var data = {};
    var page = location.href.split("/").slice(-1)[0].split(".")[0];

    if (ctl.name === 'search'   ||
        ctl.name === 'update'   ||
        ctl.name === 'save') {

        var ibox = document.getElementsByClassName('input_box')
        for (var i = 0; i < ibox.length; i++) {
            data[ibox[i].id] = ibox[i].value;
        }
        data['showing'] = showing[page];
        data['page'] = page;
    }

    if (ctl.name === 'payment') {
        var ibox = document.getElementsByClassName('input_box')
        for (var i = 0; i < ibox.length; i++) {
            data[ibox[i].id] = ibox[i].value;
        }
        data['showing'] = showing[page];
        data['page'] = 'material';
    }

    if (ctl.name === 'ordering') {
        var ibox = document.getElementsByClassName('minput_box')
        for (var i = 0; i < ibox.length; i++) {
            data[ibox[i].id] = ibox[i].value;
        }
        data['showing'] = showing['ordering'];
        data['page'] = 'ordering';
    }

    if (ctl.name === 'order') {
        var ibox = document.getElementsByClassName('minput_box')
        for (var i = 0; i < ibox.length; i++) {
            data[ibox[i].id] = ibox[i].value;
        }
        data['showing'] = showing['order'];
        data['page'] = page;
    }

    if (ctl.name === 'payment') {
        var ibox = document.getElementsByClassName('input_box')
        for (var i = 0; i < ibox.length; i++) {
            data[ibox[i].id] = ibox[i].value;
        }
        data['showing'] = showing['payment'];
        data['page'] = 'material';
    }

    if (ctl.name === 'del') {
        var row = $(ctl).parents("tr");
        var cols = row.children("td");

        for (var i = 0; i < cols.length; i++) {
            if ($(cols[i]).attr('name') === 'no') {
                data['no'] = cols[i].textContent;
                data['page'] = page;
                break;
            }
        }
    }

    if (ctl.name === 'stock') {
        data['title'] = ctl.value;
    }

    if (ctl.name === 'ibox') {
        data['kind'] = ctl.id;
        if (page == 'payment') {
            data['where'] = 'material';
        } else {
            data['where'] = page;
        }
    }

    return data;
}

function submit_to_server(data, ctl) {
    $.ajax({
        type: 'post',
        url: location.href.split("/").slice(-1)[0],
        data: data,


        success: function (response) {
            if (ctl.name === 'search'   ||
                ctl.name === 'order'    ||
                ctl.name === 'payment'  ||
                ctl.name === 'stock') {

                changeTable(response);
            }
            if (ctl.name === 'save') {
                updateRow(response);
                alert("储存完毕!");
            }
            if (ctl.name === 'update') {
                updateRow(response);
                alert("修改完毕!");
            }
            if (ctl.name === 'del') {
                deleteRow(ctl);
                alert("删除完毕!");
            }
            if (ctl.name === 'ibox') {
                updateDatalist(response, ctl);
            }
            if (ctl.name === 'logout') {
                window.location.href = 'login.php';
            }
            if (ctl.name === 'ordering') {
                alert("订货储存完毕!");
            }
        }
    });
}

function updateDatalist(src, ctl) {
    var parser = new DOMParser();
    var htmlDoc = parser.parseFromString(src, 'text/html');
    var new_page = $(htmlDoc).find('#temp_option').html();
    $("#" + ctl.id +"_list").append(new_page);
}

function submit_basic(ctl) {
    if (ctl.name === 'del') {
        if (!confirm('确定要删除吗?')) {
            return;
        }
    }
    var data = getData(ctl);
    data['msg'] = ctl.name;

    submit_to_server(data, ctl);
    return false;
}

var _row = null;
function setIBox(ctl, page) {
    _row = $(ctl).parents("tr");
    var cols = _row.children("td");
    var ibox = document.getElementsByClassName('input_box')
    for (var i = 0; i < cols.length; i++) {
        var key = $(cols[i]).attr('name');
        if (key !== 'edit' && key !== 'del') {
            $(ibox.namedItem(key)).val($(cols[i]).text());
        }
    }
}

function displayRow(ctl) {
    var name = location.href.split("/").slice(-1)[0].split(".")[0];
    setIBox(ctl, name);

    $("#updateButton").val("修整");
    $("#updateButton").attr("name", "update");

    var pos = $("#input_form").position();
    window.scrollTo(pos);
    // window.location.href = "#input_form";
}

function updateRow(src) {
    if ($("#updateButton").attr("name") == "update") {
        updateRowInTable();
    } else {
        addToTable(src);
    }
    $("#ibox_date").focus();
}

function deleteRow(ctl) {
    $(ctl).parents("tr").remove();
    formClear();
}

function formClear() {
    if ($("#updateButton").attr("name") == "update") {
        $("#updateButton").val("保存");
        $("#updateButton").attr("name", "save");
        window.location.href = "#input_form";
    }
    var ibox = document.getElementsByClassName('input_box')
    for (var i = 0; i < ibox.length; i++) {
        ibox[i].value = "";
    }
}

function addToTable(src) {
    if ($("#obc_table").length == 0) {
        return;
    }
    var parser = new DOMParser();
    var htmlDoc = parser.parseFromString(src, 'text/html');
    var new_row = $(htmlDoc).find('#temp_row').html();

    $("#obc_table tbody").prepend(new_row);
}

function updateRowInTable() {
    var cols = _row.children("td");
    var ibox = document.getElementsByClassName('input_box')

    for (var i = 0; i < cols.length; i++) {
        var key = $(cols[i]).attr('name');
        if (key !== 'edit' && key !== 'del') {
            $(cols[i]).text($(ibox.namedItem(key)).val());
        }

    }

    $("#updateButton").val("保存");
    $("#updateButton").attr("name", "save");
}

function changeTable(src) {
    var parser = new DOMParser();
    var htmlDoc = parser.parseFromString(src, 'text/html');

    if ($("#obc_table").length > 0) {
        var header = document.querySelector("#obc_table");
        header.parentElement.removeChild(header);
    }

    var new_page = $(htmlDoc).find('#temp_page').html();
    $("#table_root").append(new_page);

    formClear();

    var pos = $("#table_root").position();
    window.scrollTo(pos);
}