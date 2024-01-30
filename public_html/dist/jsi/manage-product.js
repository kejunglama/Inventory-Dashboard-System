var DOMAIN = "https://localhost/SiteUX_Inventory/public_html";
var orderCol = "";
var sort = "";

function manageProduct(pn, col) {
    orderCol = col.concat(sort);
    if (sort == "  ASC") {
        sort = " DESC";
    } else if (sort == "" || sort == " DESC") {
        sort = "  ASC";
    }

    $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: { manageProduct: 1, pageNum: pn, col: orderCol },
        success: function(data) {
            // alert(data);
            $("#product_table").html(data);
        }
    })
}

function getProductAnalysisData() {
    $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: { getProductAnalysisData: 1 },
        success: function(data) {
            var result = JSON.parse(data);

            $("#total_product").text(result['total']);
            $("#total_stock").text(result['total_stock']);
            $("#active").text(result['active']);
            $("#inactive").text(result['total'] - result['active']);
        }
    })
}

fetchList('product_category');
fetchList('product_vendor');

function fetchList($table) {
    $.ajax({
        url: DOMAIN + "/includes/process.php",
        method: "POST",
        data: { fetchList: 1, table: $table },
        success: function(data) {
            ($table == 'product_category') ? $("#select_category").html(data): $("#select_vendor").html(data);
        }
    })
}

$(document).ready(function() {
    // Pagination from PN
    $("body").delegate(".page-link", "click", function() {
        var pn = $(this).attr("pn");
        sort = "";
        if (pn.includes("ASC") || pn.includes("DESC")) {
            orderCol = orderCol.slice(0, -4);
        }
        if (orderCol) {
            manageProduct(pn, orderCol);
        } else {
            manageProduct(pn, "");
        }
        // alert(pn);
    })

    // Add Product: Button Clicked
    $("#btn_add_product").click(function() {
        $("#ModalTitle").text("Add Product");
        $("#btn_submit").text("Add Product");
        $("#btn_submit").attr("name", "add");
    })

    // Add or Update Product from 'Add Modal' over Product.php
    $("#product-form").on("submit", function() {

        if ($(".modal #name").val() == "") {
            $(".modal #name").addClass("border-danger");
            $(".modal #msg-product").html("<span class='text-danger'>Please enter a Product Name.</span>");
        } else if ($("#btn_submit").prop("name") == "add") { // Add Product
            var status = ($("#isActive").prop("checked") == 1) ? 1 : 0;
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#product-form").serialize() + "&addProduct=1&status=" + status,
                success: function(data) {
                    if (data == "PRODUCT_ADDED") {
                        console.log(data);
                        $(".modal #name").removeClass("border-danger");
                        $(".modal #name").val("");
                        $(".modal #msg-product").html("");
                        $(".modal #msg-product").html("<span class='text-success'>Product Sucessfully Added.</span>");
                        $('.modal #product-form').trigger("reset");

                        // sort table by descending order of updated_date
                        $.ajax({
                            url: DOMAIN + "/includes/process.php",
                            method: "POST",
                            data: { manageProduct: 1, pageNum: 1, col: "updated_date DESC" },
                            success: function(data) {
                                // alert(data);
                                $("#product_table").html(data);
                            }
                        });

                    } else if (data.includes("Duplicate entry")) {
                        $(".modal #msg-product").html("<span class='text-danger'>Product Already Added.</span>");
                    } else {
                        $(".modal #msg-product").html("<span class='text-danger'>Product not Added. Something went Wrong.</span>");
                        alert(data);
                        console.log(data);
                    }
                }
            })
        } else { // Update Product
            var status = ($("#isActive").prop("checked") == 1) ? 1 : 0;
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: $("#product-form").serialize() + "&updateProduct=1&status=" + status,
                success: function(data) {
                    if (data == "TABLE_UPDATED") {
                        alert("Record Sucessfully Updated!");
                        window.location.href = "";
                    } else if (data.includes("Duplicate entry")) {
                        $("#msg-category-name").html("<span class='text-danger'>Category Already Present.</span>");
                    } else {
                        alert(data);
                    }
                }
            })
        }

    })

    // Delete Product
    $("body").delegate(".del-product", "click", function() {
        var did = $(this).attr("did");
        if (confirm("Are you sure you want to delete the product?")) {
            $.ajax({
                url: DOMAIN + "/includes/process.php",
                method: "POST",
                data: { deleteProduct: 1, id: did },
                success: function(data) {
                    if (data == "RECORD_DELETED") {
                        alert("Product Sucessfully Deleted.");

                        // sort table by descending order of updated_date
                        $.ajax({
                            url: DOMAIN + "/includes/process.php",
                            method: "POST",
                            data: { manageProduct: 1, pageNum: 1, col: "updated_date DESC" },
                            success: function(data) {
                                // alert(data);
                                $("#product_table").html(data);
                                getProductAnalysisData();
                            }
                        });

                    } else {
                        alert("Something went Wrong.");
                        console.log(data);
                    }
                }
            })
        }
    })

    // Edit Product: Button Clicked
    $("body").delegate(".edit-product", "click", function() {
        var eid = $(this).attr("eid");
        // alert(eid);
        $.ajax({
            url: DOMAIN + "/includes/process.php",
            method: "POST",
            dataType: "json",
            data: { updateProductForm: 1, id: eid },
            success: function(data) {
                console.log(data);
                $("#ModalTitle").text("Update Product");
                $("#btn_submit").text("Update");
                $("#btn_submit").attr("name", "update");


                $("#id").val(data["id"]);
                $("#name").val(data["name"]);
                $("#select_category").val(data["category_id"]);
                $("#select_vendor").val(data["vendor_id"]);
                $("#selling_price").val(data["selling_price"]);
                $("#cost_price").val(data["cost_price"]);
                $("#stock").val(data["stock"]);
                var status = (data["status"] == 1) ? 1 : 0;
                $("#isActive").prop("checked", status);

            }
        })
    })


})