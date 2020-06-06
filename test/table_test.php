<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table Test</title>

    <!-- Template Main Javascript File -->
    <script src="../js/main.js"></script>
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/jquery/jquery-migrate.min.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../lib/easing/easing.min.js"></script>
    <script src="../lib/wow/wow.min.js"></script>
    <script src="../lib/superfish/hoverIntent.js"></script>
    <script src="../lib/superfish/superfish.min.js"></script>
    <script src="../lib/magnific-popup/magnific-popup.min.js"></script>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <h2>List Products</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <table id="productTable"
                   class="table table-bordered table-condensed table-striped">
                <thead>
                <tr>
                    <th>Edit</th>
                    <th>Product Name</th>
                    <th>Introduction Date</th>
                    <th>URL</th>
                    <th>Delete</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
Product Name<br>
<input id="productname"><br>
Introduction Date<br>
<input id="introdate"><br>
URL<br>
<input id="url"><br>
<button type="button" id="updateButton"
        class="btn btn-primary"
        onclick="productUpdate();">
    Add
</button>
</body>

</html>

<script>
    // Add products to <table>
    function productsAdd() {
        // First check if a <tbody> tag exists, add one if not
        if ($("#productTable tbody").length === 0) {
            $("#productTable").append("<tbody style='text-align: center'></tbody>");
        }

        // Append product to the table
        $("#productTable tbody").append(
            "<tr>" +
            // "<td><button onclick='productDisplay(this)'>E</button></td>" +
            // "<td><input style='width: 100%' value='Extending Bootstrap with CSS, JavaScript and jQuery'></td>" +
            // "<td><input style='width: 100%' value='6/11/2015'></td>" +
            // "<td><input style='width: 100%' value='http://bit.ly/1SNzc0i'></td>" +
            "<td><button onclick='productDisplay(this)'>E</button></td>" +
            "<td>Extending Bootstrap with CSS, JavaScript and jQuery</td>" +
            "<td>6/11/2015</td>" +
            "<td>http://bit.ly/1SNzc0i</td>" +
            "<td><button onclick='productDelete(this)'>X</button></td>" +
            "</tr>"
    )
        $("#productTable tbody").append(
            "<tr>" +
            "<td><button onclick='productDisplay(this)'>E</button></td>" +
            // "<td><input style='width: 100%' value='Build your own Bootstrap Business Application Template in MVC'></td>" +
            // "<td><input style='width: 100%' value='1/29/2015'></td>" +
            // "<td><input style='width: 100%' value='http://bit.ly/1I8ZqZg'></td>" +
            "<td>Build your own Bootstrap Business Application Template in MVC</td>" +
            "<td>1/29/2015</td>" +
            "<td>http://bit.ly/1I8ZqZg</td>" +
            "<td><button onclick='productDelete(this)'>X</button></td>" +
            "</tr>"
    )
    }

    function productUpdate() {
        if ($("#updateButton").text() == "Update") {
            productUpdateInTable();
        } else {
            // Add product to Table
            productAddToTable();
        }
        // Clear form fields
        formClear();
        // Focus to product name field
        $("#productname").focus();
    }

    function productDelete(ctl) {
        $(ctl).parents("tr").remove();
    }

    function formClear() {
        $("#productname").val("");
        $("#introdate").val("");
        $("#url").val("");
    }

    function productAddToTable() {
        // First check if a <tbody> tag exists, add one if not
        if ($("#productTable tbody").length == 0) {
            $("#productTable").append("<tbody></tbody>");
        }

        // Append product to the table
        $("#productTable tbody").append(
            "<tr>" +
            // "<td><button onclick='productDisplay(this)'>E</button></td>" +
            // "<td><input style='width: 100%' value=" + $("#productname").val() + "></td>" +
            // "<td><input style='width: 100%' value=" + $("#introdate").val() + "></td>" +
            // "<td><input style='width: 100%' value=" + $("#url").val() + "></td>" +
            // "<td><button onclick='productDelete(this)'>X</button></td>" +
            "<td><button onclick='productDisplay(this)'>E</button></td>" +
            "<td>" + $("#productname").val() + "</td>" +
            "<td>" + $("#introdate").val() + "</td>" +
            "<td>" + $("#url").val() + "</td>" +
            "<td><button onclick='productDelete(this)'>X</button></td>" +
            "</tr>"
        );
    }

    var _row = null;
    function productDisplay(ctl) {
        _row = $(ctl).parents("tr");
        var cols = _row.children("td");
        _activeId = $($(cols[0]).children("button")[0]).data("id");
        $("#productname").val($(cols[1]).text());
        $("#introdate").val($(cols[2]).text());
        $("#url").val($(cols[3]).text());
        // Change Update Button Text
        $("#updateButton").text("Update");
    }

    function productUpdateInTable() {
        // Add changed product to table
        $(_row).after(productBuildTableRow(_activeId));
        // Remove old product row
        $(_row).remove();
        // Clear form fields
        formClear();
        // Change Update Button Text
        $("#updateButton").text("Add");
    }
    // Next ID for adding a new Product
    var _nextId = 1;
    // ID of Product currently editing
    var _activeId = 0;
    function productBuildTableRow(id) {
        var ret =
            "<tr>" +
            "<td>" +
            "<button type='button' " +
            "onclick='productDisplay(this);' " +
            "class='btn btn-default' " +
            "data-id='" + id + "'>" +
            "<span class='glyphicon glyphicon-edit' />" +
            "E</button>" +
            "</td>" +
            "<td>" + $("#productname").val() + "</td>" +
            "<td>" + $("#introdate").val() + "</td>" +
            "<td>" + $("#url").val() + "</td>" +
            "<td>" +
            "<button type='button' " +
            "onclick='productDelete(this);' " +
            "class='btn btn-default' " +
            "data-id='" + id + "'>" +
            "<span class='glyphicon glyphicon-remove' />" +
            "X</button>" +
            "</td>" +
            "</tr>"

        return ret;
    }

    $(document).ready(function () {
        productsAdd();
    });
</script>