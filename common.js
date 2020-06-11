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
    class_list:
        '<option value="白瓷"></option>' +
        '<option value="花纸"></option>' +
        '<option value="完成品"></option>' +
        '<option value="包装物"></option>' +
        '<option value="彩瓷"></option>'
};

var showing = {
    material: {
        no:         false,
        date:       true,
        supplier:   false,
        item:       true,
        design:     true,
        qty:        true,
        month:      false,
        class:      true,
        worker:     false,
        edit:       true,
        del:        true
    },
    stock: {
        no:         false,
        item:       true,
        design:     true,
        qty:        true,
        class:      true,
        edit:       true,
        del:        true
    },
    custom: {
        no:         false,
        date:       true,
        customer:   true,
        item:       true,
        design:     true,
        qty:        true,
        orderno:    true,
        edit:       true,
        del:        true
    },
    ordering: {
        no:         false,
        date:       true,
        supplier:   true,
        item:       true,
        qty:        true,
        class:      true,
        edit:       true,
        del:        true
    },
    // payment: {
    //     no:         false,
    //     date:       true,
    //     item:       true,
    //     design:     true,
    //     class:      true,
    //     qty:        true,
    //     price:      true,
    //     total:      true,
    //     edit:       true,
    //     del:        true
    // },
    price: {
        no:         false,
        factory:    true,
        item:       true,
        design:     true,
        price:      true,
        class:      true,
        edit:       true,
        del:        true
    },
    shipping: {
        no:         false,
        supplier:   false,
        item:       true,
        design:     true,
        class:      true,
        rate:       true,
        price:      true,
        worker:     false,
        edit:       true,
        del:        true
    }
};

for (var key in datalist) {
    var elem = document.getElementById(key);
    if (elem != null) {
        elem.innerHTML = datalist[key];
    }
}

function getData(ctl) {
    var data = {};
    var page = location.href.split("/").slice(-1)[0].split(".")[0];
    if (ctl.name === 'update') {
        var row = $(ctl).parents("tr");
        var cols = row.children("td");

        for (var i = 0; i < cols.length; i++) {
            if (cols[i].children.length === 0) {
                data[$(cols[i]).attr('name')] = cols[i].textContent;
            }
        }
        data['showing'] = showing[page];
        data['page'] = page;
    }
    if (ctl.name === 'del') {
        var row = $(ctl).parents("tr");
        var cols = row.children("td");

        for (var i = 0; i < cols.length; i++) {
            if ($(cols[i]).attr('name') === 'no') {
                data['no'] = cols[i].textContent;
                break;
            }
        }
    }
    if (ctl.name === 'logout') {
        data['page'] = page;
    }
    if (ctl.name === 'search') {
        var ibox = document.getElementsByClassName('input_box')
        for (var i = 0; i < ibox.length; i++) {
            data[ibox[i].name] = ibox[i].value;
        }
        data['showing'] = showing[page];
        data['page'] = page;
    }

    return data;
}

function submit_data(ctl) {
    if (ctl.name === 'del') {
        if (!confirm('确定要删除吗?')) {
            return;
        }
    }
    var data = getData(ctl);
    data['msg'] = ctl.name;

    $.ajax({
        type: 'post',
        url: data['page'] + '.php',
        data: data,

        success: function (response) {
            if (ctl.name === 'search' || ctl.name === 'stock') {
                changeTable(response);
            }
            if (ctl.name === 'save') {
                updateRow(response);
                alert("저장 완료");
            }
            if (ctl.name === 'update') {
                updateRow(response);
                alert("수정 완료");
            }
            if (ctl.name === 'del') {
                deleteRow(ctl);
                alert("삭제 완료");
            }
            if (ctl.name === 'logout') {
                window.location.href = 'login.php';
            }
        }
    });
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
    window.location.href = "#input_form";
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
}