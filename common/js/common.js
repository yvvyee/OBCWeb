import("lib/jquery/jquery.min.js");
import("lib/jquery/jquery-migrate.min.js");

// automation - ESC 키 처리
$(document).keydown(function(e) {
    // ESCAPE key pressed
    if (e.keyCode === 27) {
        formClear();
    }
});
// input_form 생성
$(function () {
    $('#obc_title').load('common/html/title.html');
    $('#home_button').load('common/html/home.html');
    $('#common_part').load('common/html/modal.html');

    var page = location.href.split("/").slice(-1)[0].split(".")[0];
    submit_input(page);
});
// 페이지 리프레시 비활성
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}
// 테이블 디스플레이 설정
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
        carton:     'show',
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
    },
    datalist: {
        no:         'none',
        name:       'show',
        kind:       'show',
        seq:        'show',
        sep:        'show',
        edit:       'show',
        del:        'show'
    }
};
// submit 메시지 & 데이터 생성
function craeteSubmitMsg(ctl) {
    var data = {};
    var page = location.href.split("/").slice(-1)[0].split(".")[0];

    if (ctl.name === 'search'   ||
        ctl.name === 'update'   ||
        ctl.name === 'save') {

        var ibox = document.getElementsByClassName('input_box')
        var cbox = document.getElementsByClassName('check_box')
        var cols = {};
        var show = {};
        for (var i = 0; i < ibox.length; i++) {
            if (ibox[i].id.split('_')[1] === page) {
                cols[ibox[i].name] = ibox[i].value;
                show[ibox[i].name] = cbox[i].checked;
            }
        }
        // data['showing'] = showing[page];
        data['page'] = page;
        data['cols'] = cols;
        data['show'] = show;
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

    if (ctl.name === 'payment') {
        var ibox = document.getElementsByClassName('input_box')
        var cols = {};
        for (var i = 0; i < ibox.length; i++) {
            cols[ibox[i].name] = ibox[i].value;
        }
        // data['showing'] = showing[page];
        data['page'] = 'material';
        data['cols'] = cols;
    }
    // custom 페이지 모달 발주내용 저장
    if (ctl.name === 'ordering') {
        var ibox = document.getElementsByClassName('input_box')
        var cols = {};
        for (var i = 0; i < ibox.length; i++) {
            if (ibox[i].id.split('_')[0] === 'ordering') {
                cols[ibox[i].name] = ibox[i].value;
            }
        }
        // data['showing'] = showing['ordering'];
        data['page'] = 'ordering';
        data['cols'] = cols;
    }
    // custom 페이지 발주테이블 생성
    if (ctl.name === 'order') {
        var ibox = document.getElementsByClassName('input_box')
        var cbox = document.getElementsByClassName('check_box')
        var cols = {};
        var show = {};
        for (var i = 0; i < ibox.length; i++) {
            if (ibox[i].id.split('_')[0] === page) {
                cols[ibox[i].name] = ibox[i].value;
                show[ibox[i].name] = cbox[i].checked;
            }
        }
        // data['showing'] = showing['order'];
        data['page'] = page;
        data['cols'] = cols;
        data['show'] = show;
    }

    // if (ctl.name === 'payment') {
    //     var ibox = document.getElementsByClassName('input_box')
    //     for (var i = 0; i < ibox.length; i++) {
    //         data[ibox[i].name] = ibox[i].value;
    //     }
    //     data['showing'] = showing['payment'];
    //     data['page'] = 'material';
    // }

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
// submit: input_form 생성
function submit_input(page) {
    $.ajax({
        type: 'post',
        url: location.href.split("/").slice(-1)[0],
        data: {
            'msg': 'setInput',
            'page': page
        },
        success: function (response) {
            var parser = new DOMParser();
            var htmlDoc = parser.parseFromString(response, 'text/html');

            var new_page = $(htmlDoc).find('#temp_page').html();
            $("#input_form_" + page).append(new_page);

            if (page == 'custom') {
                submit_input('ordering');
            }
        }
    });
}
// submit 진입점
function submit_basic(ctl) {
    if (ctl.name === 'del') {
        if (!confirm('确定要删除吗?')) {
            return;
        }
    }
    var data = craeteSubmitMsg(ctl);
    data['msg'] = ctl.name;

    submit_to_server(data, ctl);
    return false;
}
// submit: 메시지 전송
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
                updateTable(response);
            }
            if (ctl.name === 'update') {
                updateTable(response);
            }
            if (ctl.name === 'del') {
                deleteRow(ctl);
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

// function updateDatalist(src, ctl) {
//     var parser = new DOMParser();
//     var htmlDoc = parser.parseFromString(src, 'text/html');
//     var new_page = $(htmlDoc).find('#temp_option').html();
//     $("#" + ctl.id +"_list").append(new_page);
// }

// 입력창으로 로드
var _row = null;
function loadToInputBox(ctl, page) {
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
// 테이블 수정 진입점
function displayRow(ctl) {
    var name = location.href.split("/").slice(-1)[0].split(".")[0];
    loadToInputBox(ctl, name);

    $("#updateButton").val("修整");
    $("#updateButton").attr("name", "update");

    var pos = $("#obc_title").position();
    window.scrollTo(pos);
}
// 테이블 메인 함수
function updateTable(src) {
    if ($("#updateButton").attr("name") == "update") {
        updateRow();
    } else {
        addRow(src);
    }
    $("#ibox_date").focus();
}
// 테이블에서 삭제
function deleteRow(ctl) {
    $(ctl).parents("tr").remove();
    formClear();
}
// 입력창 초기화
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
// 테이블에 추가
function addRow(src) {
    if ($("#obc_table").length == 0) {
        return;
    }
    var parser = new DOMParser();
    var htmlDoc = parser.parseFromString(src, 'text/html');
    var new_row = $(htmlDoc).find('#temp_row').html();

    $("#obc_table tbody").prepend(new_row);
}
// 수정내용 반영
function updateRow() {
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
// 새 테이블로 교체
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