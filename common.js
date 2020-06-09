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

function submit_data(ctl)
{
    var msg = ctl.name;
    if (msg === 'del') {
        fillIBox(ctl);
    }
    var ib_no = document.getElementById( "ibox_no" );
    var ib_date = document.getElementById( "ibox_date" );
    var ib_supplier = document.getElementById( "ibox_supplier" );
    var ib_item = document.getElementById( "ibox_item" );
    var ib_design = document.getElementById( "ibox_design" );
    var ib_qty = document.getElementById( "ibox_qty" );
    var ib_month = document.getElementById( "ibox_month" );
    var ib_class = document.getElementById( "ibox_class" );
    var ib_worker = document.getElementById( "ibox_worker" );

    $.ajax({
        type: 'post',
        url: 'material.php',
        data: {
            msg:msg,
            no:ib_no.value,
            date:ib_date.value,
            supplier:ib_supplier.value,
            item:ib_item.value,
            design:ib_design.value,
            qty:ib_qty.value,
            month:ib_month.value,
            class:ib_class.value,
            worker:ib_worker.value,
        },

        success: function (response) {
            if (msg === 'search') {
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
    if ($("#obc_table", "tbody").length === 0) {
        $("#obc_table").append("<tbody></tbody>");
    }
    $("#obc_table").children("tbody").children("tr").prepend(content_str)
}

var _row = null;

function fillIBox(ctl) {
    _row = $(ctl).parents("tr");
    var cols = _row.children("td");

    $("#ibox_no").val($(cols[0]).text());
    $("#ibox_date").val($(cols[1]).text());
    $("#ibox_supplier").val($(cols[2]).text());
    $("#ibox_item").val($(cols[3]).text());
    $("#ibox_design").val($(cols[4]).text());
    $("#ibox_qty").val($(cols[5]).text());
    $("#ibox_month").val($(cols[6]).text());
    $("#ibox_class").val($(cols[7]).text());
    $("#ibox_worker").val($(cols[8]).text());
}

function displayRow(ctl) {
    fillIBox(ctl);

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
    $("#ibox_no").val("");
    $("#ibox_date").val("");
    $("#ibox_supplier").val("");
    $("#ibox_item").val("");
    $("#ibox_design").val("");
    $("#ibox_qty").val("");
    $("#ibox_month").val("");
    $("#ibox_class").val("");
    $("#ibox_worker").val("");
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

    $(cols[0]).text($("#ibox_no").val());
    $(cols[1]).text($("#ibox_date").val());
    $(cols[2]).text($("#ibox_supplier").val());
    $(cols[3]).text($("#ibox_item").val());
    $(cols[4]).text($("#ibox_design").val());
    $(cols[5]).text($("#ibox_qty").val());
    $(cols[6]).text($("#ibox_month").val());
    $(cols[7]).text($("#ibox_class").val());
    $(cols[8]).text($("#ibox_worker").val());

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

// if ( window.history.replaceState ) {
//     window.history.replaceState( null, null, window.location.href );
// }
//
// // var table_id = null;
// function submit_data(ctl)
// {
//     var msg = ctl.name;
//     if (msg === 'del') {
//         fillIBox(ctl);
//     }
//     var ib_no = document.getElementById( "ibox_no" );
//     var ib_item = document.getElementById( "ibox_item" );
//     var ib_design = document.getElementById( "ibox_design" );
//     var ib_qty = document.getElementById( "ibox_qty" );
//     var ib_class = document.getElementById( "ibox_class" );
//     var ib_worker = document.getElementById( "ibox_worker" );
//
//     $.ajax({
//         type: 'post',
//         url: 'stock.php',
//         data: {
//             msg:msg,
//             no:ib_no.value,
//             item:ib_item.value,
//             design:ib_design.value,
//             qty:ib_qty.value,
//             class:ib_class.value,
//             worker:ib_worker.value,
//         },
//
//         success: function (response) {
//             if (msg === 'search') {
//                 changeTable(response);
//                 // table_id = "#basic_table";
//             }
//             if (msg === 'make') {
//                 changeTable(response);
//                 // table_id = "#stock_table";
//             }
//             if (msg === 'save') {
//                 updateRow(response);
//                 alert("저장 완료");
//             }
//             if (msg === 'update') {
//                 updateRow(response);
//                 alert("수정 완료");
//             }
//             if (msg === 'del') {
//                 deleteRow(ctl);
//                 alert("삭제 완료");
//             }
//         }
//     });
//     return false;
// }
//
// function addRow(content_str) {
//     if ($(table_id, "tbody").length === 0) {
//         $(table_id).append("<tbody></tbody>");
//     }
//     $(table_id).children("tbody").children("tr").prepend(content_str)
// }
//
// var _row = null;
// function fillIBox(ctl) {
//     _row = $(ctl).parents("tr");
//     var cols = _row.children("td");
//
//     $("#ibox_no").val($(cols[0]).text());
//     $("#ibox_item").val($(cols[1]).text());
//     $("#ibox_design").val($(cols[2]).text());
//     $("#ibox_qty").val($(cols[3]).text());
//     $("#ibox_class").val($(cols[4]).text());
//     $("#ibox_worker").val($(cols[5]).text());
// }
//
// function displayRow(ctl) {
//     _activeId = ctl.id;
//
//     fillIBox(ctl);
//
//     $("#updateButton").val("Update");
//     $("#updateButton").attr("name", "update");
//     window.location.href = "#input_form";
// }
//
// function updateRow(src) {
//     if ($("#updateButton").val() == "Update") {
//         updateRowInTable();
//     } else {
//         addToTable(src);
//     }
//     $("#ibox_item").focus();
// }
//
// function deleteRow(ctl) {
//     $(ctl).parents("tr").remove();
//     formClear();
// }
//
// function formClear() {
//     if ($("#updateButton").val() == "Update") {
//         $("#updateButton").val("Save");
//         $("#updateButton").attr("name", "save");
//         window.location.href = "#input_form";
//     }
//     $("#ibox_no").val("");
//     $("#ibox_item").val("");
//     $("#ibox_design").val("");
//     $("#ibox_qty").val("");
//     $("#ibox_class").val("");
//     $("#ibox_worker").val("");
// }
//
// function isEmpty(str) {
//     return (!str || 0 === str.length);
// }
//
// function addToTable(src) {
//     delTable("#stock_table");
//     if ($("#basic_table").length == 0) {
//         $("#table_root").append("<table id='basic_table' class='responsive-table' style='min-font-size: 9pt'>"
//             + "<thead>"
//             + "<tr>"
//             + "<th style='display: none'>No</th>"
//             + "<th>Item</th>"
//             + "<th>Design</th>"
//             + "<th>Qty</th>"
//             + "<th>Class</th>"
//             + "<th style='display: none'>Worker</th>"
//             + "<th>Edit</th>"
//             + "<th>Del</th>"
//             + "</tr>"
//             + "</thead>"
//             + "<tbody></tbody>");
//     }
//
//     var parser = new DOMParser();
//     var htmlDoc = parser.parseFromString(src, 'text/html');
//     var new_row = $(htmlDoc).find('#temp_row').html();
//
//     $("#basic_table tbody").prepend(new_row);
// }
//
// function updateRowInTable() {
//     var cols = _row.children("td");
//
//     $(cols[0]).text($("#ibox_no").val());
//     $(cols[1]).text($("#ibox_item").val());
//     $(cols[2]).text($("#ibox_design").val());
//     $(cols[3]).text($("#ibox_qty").val());
//     $(cols[4]).text($("#ibox_class").val());
//     $(cols[5]).text($("#ibox_worker").val());
//
//     formClear();
//
//     $("#updateButton").val("Save");
//     $("#updateButton").attr("name", "save");
// }
//
// function delTable(table_id) {
//     if ($(table_id).length > 0) {
//         header = document.querySelector(table_id);
//         header.parentElement.removeChild(header);
//     }
// }
//
// function changeTable(src) {
//     _activeId = 0;
//     _nextId = 0;
//     var parser = new DOMParser();
//     var htmlDoc = parser.parseFromString(src, 'text/html');
//
//     delTable("#basic_table");
//     delTable("#stock_table");
//
//     var new_page = $(htmlDoc).find('#temp_page').html();
//     $("#table_root").append(new_page);
//
//     formClear();
// }
//
// $(document).keydown(function(e) {
//     // ESCAPE key pressed
//     if (e.keyCode == 27) {
//         formClear();
//     }
// });
