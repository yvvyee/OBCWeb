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

function getCols(msg, page, ctl) {
    var row = $(ctl).parents("tr");
    var cols = row.children("td");

    if (page === 'material') {
        return {
            msg:        msg,
            page:       page,
            no:         $(cols[0]).text(),
            date:       $(cols[1]).text(),
            supplier:   $(cols[2]).text(),
            item:       $(cols[3]).text(),
            design:     $(cols[4]).text(),
            qty:        $(cols[5]).text(),
            month:      $(cols[6]).text(),
            class:      $(cols[7]).text(),
            worker:     $(cols[8]).text()
        }
    } else if (page === 'basic') {
        return {
            msg:        msg,
            page:       page,
            no:         $(cols[0]).text(),
            item:       $(cols[1]).text(),
            design:     $(cols[2]).text(),
            qty:        $(cols[3]).text(),
            class:      $(cols[4]).text()
        }
    } else if (page === 'shipping') {
        return {
            msg:        msg,
            page:       page,
            no:         $(cols[0]).text(),
            supplier:   $(cols[1]).text(),
            item:       $(cols[2]).text(),
            design:     $(cols[3]).text(),
            class:      $(cols[4]).text(),
            rate:       $(cols[5]).text(),
            price:      $(cols[6]).text(),
            worker:     $(cols[7]).text()
        }
    }
    else {
        return null;
    }
}

function getIbox(msg, page) {
    if (page === 'material') {
        return {
            msg:        msg,
            page:       page,
            no:         document.getElementById( "ibox_no" ).value,
            date:       document.getElementById( "ibox_date" ).value,
            supplier:   document.getElementById( "ibox_supplier" ).value,
            item:       document.getElementById( "ibox_item" ).value,
            design:     document.getElementById( "ibox_design" ).value,
            qty:        document.getElementById( "ibox_qty" ).value,
            month:      document.getElementById( "ibox_month" ).value,
            class:      document.getElementById( "ibox_class" ).value,
            worker:     document.getElementById( "ibox_worker" ).value
        }
    } else if (page === 'basic') {
        return {
            msg:        msg,
            page:       page,
            no:         document.getElementById( "ibox_no" ).value,
            item:       document.getElementById( "ibox_item" ).value,
            design:     document.getElementById( "ibox_design" ).value,
            qty:        document.getElementById( "ibox_qty" ).value,
            class:      document.getElementById( "ibox_class" ).value,
        }
    } else if (page === 'shipping') {
        return {
            msg:        msg,
            page:       page,
            no:         document.getElementById( "ibox_no" ).value,
            supplier:   document.getElementById( "ibox_supplier" ).value,
            item:       document.getElementById( "ibox_item" ).value,
            design:     document.getElementById( "ibox_design" ).value,
            class:      document.getElementById( "ibox_class" ).value,
            rate:       document.getElementById( "ibox_rate" ).value,
            price:      document.getElementById( "ibox_price" ).value,
            worker:     document.getElementById( "ibox_worker" ).value
        }
    } else {
        return null;
    }
}

function getData(msg, page, ctl) {
    if (msg === 'del') {
        return getCols(msg, page, ctl);
    } else {
        return getIbox(msg, page);
    }
}

function checkData(msg, page, data) {
    if (page === 'material') {
        if (msg === 'save' || msg === 'update') {
            if (isEmpty(data['date'])) {
                alert("date 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['supplier'])) {
                alert("supplier 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['item'])) {
                alert("item 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['design'])) {
                alert("design 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['qty'])) {
                alert("quantity 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['class'])) {
                alert("class 값을 입력하세요.");
                return false;
            }
        }
    } else if (page === 'basic') {
        if (msg === 'save' || msg === 'update') {
            if (isEmpty(data['item'])) {
                alert("item 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['design'])) {
                alert("design 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['qty'])) {
                alert("quantity 값을 입력하세요.");
                return false;
            }
            if (isEmpty(data['class'])) {
                alert("class 값을 입력하세요.");
                return false;
            }
        }
    } else if (page === 'shipping') {

    } else {
        return true;
    }
}

function submit_data(ctl) {
    var page = location.href.split("/").slice(-1)[0].split(".")[0];
    var msg = ctl.name;

    if (msg === 'del') {
        if (!confirm('确定要删除吗?')) {
            return;
        }
    }

    var data = getData(msg, page, ctl);
    if (checkData(msg, page, data)) { return; }

    $.ajax({
        type: 'post',
        url: page + '.php',
        data: data,

        success: function (response) {
            if (msg === 'search' || msg === 'stock') {
                changeTable(response);
            }
            if (msg === 'save') {
                updateRow(response);
                alert("저장 완료");
            }
            if (msg === 'update') {
                updateRow(response);
                alert("수정 완료");
            }
            if (msg === 'del') {
                deleteRow(ctl);
                alert("삭제 완료");
            }
        }
    });
    return false;
}

function openForm(elem, self) {
    var doc = document.getElementById(elem);
    if (doc.style.display === "block") {
        doc.style.display = "none";
    } else {
        doc.style.display = "block";
    }
}

function closeForm(id) {
    document.getElementById(id).style.display = "none";
}

function addRow(content_str) {
    $("#obc_table").children("tbody").children("tr").prepend(content_str)
}

var _row = null;
function setIBox(ctl, page) {
    _row = $(ctl).parents("tr");
    var cols = _row.children("td");
    if (page === 'material') {
        $("#ibox_no"        ).val($(cols[0]).text());
        $("#ibox_date"      ).val($(cols[1]).text());
        $("#ibox_supplier"  ).val($(cols[2]).text());
        $("#ibox_item"      ).val($(cols[3]).text());
        $("#ibox_design"    ).val($(cols[4]).text());
        $("#ibox_qty"       ).val($(cols[5]).text());
        $("#ibox_month"     ).val($(cols[6]).text());
        $("#ibox_class"     ).val($(cols[7]).text());
        $("#ibox_worker"    ).val($(cols[8]).text());
    } else if (page === 'basic') {
        $("#ibox_no"        ).val($(cols[0]).text());
        $("#ibox_item"      ).val($(cols[1]).text());
        $("#ibox_design"    ).val($(cols[2]).text());
        $("#ibox_qty"       ).val($(cols[3]).text());
        $("#ibox_class"     ).val($(cols[4]).text());
    } else if (page === 'shipping') {
        $("#ibox_no"        ).val($(cols[0]).text());
        $("#ibox_supplier"  ).val($(cols[1]).text());
        $("#ibox_item"      ).val($(cols[2]).text());
        $("#ibox_design"    ).val($(cols[3]).text());
        $("#ibox_class"     ).val($(cols[4]).text());
        $("#ibox_rate"      ).val($(cols[5]).text());
        $("#ibox_price"     ).val($(cols[6]).text());
        $("#ibox_worker"    ).val($(cols[7]).text());
    } else {

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
    var page = location.href.split("/").slice(-1)[0].split(".")[0];
    if (page === 'material') {
        $("#ibox_no"        ).val("");
        $("#ibox_date"      ).val("");
        $("#ibox_supplier"  ).val("");
        $("#ibox_item"      ).val("");
        $("#ibox_design"    ).val("");
        $("#ibox_qty"       ).val("");
        $("#ibox_month"     ).val("");
        $("#ibox_class"     ).val("");
        $("#ibox_worker"    ).val("");
    } else if (page === 'basic') {
        $("#ibox_no"        ).val("");
        $("#ibox_item"      ).val("");
        $("#ibox_design"    ).val("");
        $("#ibox_qty"       ).val("");
        $("#ibox_class"     ).val("");
    } else if (page === 'shipping') {
        $("#ibox_no"        ).val("");
        $("#ibox_supplier"  ).val("");
        $("#ibox_item"      ).val("");
        $("#ibox_design"    ).val("");
        $("#ibox_class"     ).val("");
        $("#ibox_rate"      ).val("");
        $("#ibox_price"     ).val("");
        $("#ibox_worker"    ).val("");
    } else {

    }
}

function isEmpty(str) {
    return (!str || 0 === str.length);
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

    var page = location.href.split("/").slice(-1)[0].split(".")[0];
    if (page === 'material') {
        $(cols[0]).text($("#ibox_no"        ).val());
        $(cols[1]).text($("#ibox_date"      ).val());
        $(cols[2]).text($("#ibox_supplier"  ).val());
        $(cols[3]).text($("#ibox_item"      ).val());
        $(cols[4]).text($("#ibox_design"    ).val());
        $(cols[5]).text($("#ibox_qty"       ).val());
        $(cols[6]).text($("#ibox_month"     ).val());
        $(cols[7]).text($("#ibox_class"     ).val());
        $(cols[8]).text($("#ibox_worker"    ).val());
    } else if (page === 'stock') {
        $(cols[0]).text($("#ibox_no"        ).val());
        $(cols[1]).text($("#ibox_item"      ).val());
        $(cols[2]).text($("#ibox_design"    ).val());
        $(cols[3]).text($("#ibox_qty"       ).val());
        $(cols[4]).text($("#ibox_class"     ).val());
    } else if (page === 'shipping') {
        $(cols[0]).text($("#ibox_no"        ).val());
        $(cols[1]).text($("#ibox_supplier"  ).val());
        $(cols[2]).text($("#ibox_item"      ).val());
        $(cols[3]).text($("#ibox_design"    ).val());
        $(cols[4]).text($("#ibox_class"     ).val());
        $(cols[5]).text($("#ibox_rate"      ).val());
        $(cols[6]).text($("#ibox_price"     ).val());
        $(cols[7]).text($("#ibox_worker"    ).val());
    } else {

    }

    formClear();

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