@extends('layout.app')
@section('page-content')
    <div class="dashboard-menu">
        <div class="dashboard-header">
            <span>
                <h2 style="font-weight: bold;">Dashboard</h2>
            </span>
            <span><a href="" style="color:orangered;text-decoration:none; font-weight:bold">Home</a>/Sales</span>
        </div>

        <div class="item-container">
            <div class="item-search-bar">
                <div><input type="search" name="" id="search-item" placeholder="Search for item..."
                        class="search-item">
                </div>
                <div id="item-box">
                    <div>
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Pack Price</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="sales-item-table-body">

                                <tr style="text-align: center">
                                    <td>Make search to show items...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="item-price-box">
                <div class="shopping-cart-box">
                    <div class="shopping-cart">
                        <div><span style="font-weight: bold">Total: <span id="t-price">0</span>Ghs </span></div>

                        <div class="sales-btns">
                            <button style="background-color:orangered" id="preview-items">Preview</button>
                            <button style="background-color: black" id="clear-shopping-cart">Clear</button>

                        </div>
                    </div>
                    <form class="preview-items-form">


                        <button id="submit"
                            style="background-color: blue; color:white; border:none;font-weight:bold; cursor:pointer">Submit</button>

                        <div class="preview-items">
                            <h4>No item for preview</h4>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="sales-tables-conatiner">
            <div class="table-header">
                <div class="table-tabs-btns">
                    <button onclick="changeTab(0)">Sales history</button>
                    <button onclick="changeTab(1)">Daily sales</button>
                </div>
                 <div style="color: white;font-weight:bold"> Total Amount:
                    <span id="total-sell-amount" style="color:orangered; font-size:1.6rem">200</span>
                 </div>
            </div>
            <div class="tablePanels">
                <div class="tab-content" >
                    <div class="table-container ">
                        <table class="content-table" id="sales-history-table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Product Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-content" style="display:none">
                    <div class="table-container sales-table">

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        var preview_form_data = ``
        var product_counter = 0;
        $("#search-item").on("keyup", function() {
            var item = this.value;

            if (item !== '') {

                var data = {
                    "item": item,
                    "shop_code": `${shop_code}`
                }
                var data2 = JSON.stringify(data)
                fetch(`${appUrl}/api/sales/searchItem/${data2}`, {
                    method: "GET",

                }).then(function(res) {
                    return res.json();
                }).then(function(data) {
                    var product = ``
                    data.data.forEach(element => {

                        product +=
                            `<tr>
                            <td>${element.product_name}</td>
                            <td>${element.pack_price}</td>
                            <td>${element.unit_price}</td>
                            <td><input class="product-quantity" value="0" dataset="${element.unit_price}" productname="${element.product_name}"/></td>
                        </tr>
                        `
                    });

                    $("#sales-item-table-body").html(product)

                    $(".product-quantity").change(function() {
                        var changedValue = this.value
                        var price = this.getAttribute("dataset")
                        var totalPrice = Number($("#t-price").html());
                        totalPrice += price * changedValue;
                        $("#t-price").html(totalPrice)
                        product_counter++;
                        preview_form_data += `<div class="preview-list">
                            <input type="hidden" value="${this.getAttribute("dataset")}" name="price${product_counter}"/>
                            <input type="hidden" value="${this.getAttribute("productname")}" name="sold_product_price${product_counter}" />
                            <span>${this.getAttribute("productname")}</span>
                            <span><input class="product-quantity" value="${changedValue}" name="product${product_counter}"/></span>
                            </div>`
                        $(".preview-items").html(preview_form_data)
                    });


                }).catch(function(err) {
                    if (err) {
                        console.log(err);
                    }
                })


            } else {
                var output = `<td>Make search to show items...</td></tr>`
                $("#sales-item-table-body").html(output)
            };

        });
        //clearing shopping cart
        $("#clear-shopping-cart").click(function() {
            var output = `<td>Make search to show items...</td></tr>`
            $("#t-price").html(0)
            $("#search-item").val(' ');
            $("#sales-item-table-body").html(output)
            $(".preview-items").html('')
        })
        // showing items for preview
        $("#preview-items").click(function() {
            $(".preview-items").toggle()
        })
        //submitting sold items
        var form = document.querySelector(".preview-items-form")
        $(".preview-items-form").submit(function(e) {
            e.preventDefault()

            let formdata = new FormData(form)
            formdata.append("shop_code", `${shop_code}`)
            formdata.append("user", `${user_id}`)
            formdata.append("product_counter", `${product_counter}`)
            Swal.fire({
                title: 'Are you sure you want to sell product(s)?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Add',
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        text: "Processing, please wait...",
                        showConfirmButton: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    });
                    fetch(`${appUrl}/api/sales/addProduct`, {
                        method: "post",
                        body: formdata
                    }).then(function(res) {
                        return res.json();
                    }).then(function(data) {
                        if (!data.ok) {
                            Swal.fire({
                                text: data.msg,
                                type: "error"
                            });
                            return;
                        }
                        Swal.fire({
                            text: "Product(s) sold successfully",
                            type: "success"
                        });
                        salesTable .ajax.reload(false,null)
                        var output = `<td>Make search to show items...</td></tr>`
                        $("#t-price").html(0)
                        $("#search-item").val(' ');
                        $("#sales-item-table-body").html(output)
                        $(".preview-items").html('')
                    }).catch(function(err) {
                        if (err) {
                            Swal.fire({
                                text: "Processing products failed"
                            });
                        }
                    })
                }
            })



        })
        let tabs = document.querySelectorAll(".tab-content");
        let tabsBtns = document.querySelectorAll(".table-tabs-btns button")

        function changeTab(tabIndex) {
            tabs.forEach(element => {
                element.style.display = "none"
            })
            tabs[tabIndex].style.display = "block"
        }

        //fetching sales history
        var salesTable = $('#sales-history-table').DataTable({
            "lengthChange": false,
            dom: 'Bfrtip',
            ajax: {
                url: `${appUrl}/api/sales/${shop_code}`,
                type: "GET",
            },
            processing: true,
            responsive: true,
            columns: [{
                    data: "product_name"
                },
                {
                    data: "product_quantity"
                },

                {
                    data: "unit_price"
                },
                {
                    data: "cost"
                },
                {
                    data: "action"
                }
            ],
            buttons: [{
                    extend: 'print',
                    // title: `${loggedInUserSchoolName} - program List`,
                    attr: {
                        class: "btn-color btn-print"
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3]
                    }
                },
                {
                    extend: 'copy',
                    // title: `${loggedInUserSchoolName} - program List`,
                    attr: {
                        class: "btn-color btn-copy"
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excel',
                    // title: `${loggedInUserSchoolName} - program List`,
                    attr: {
                        class: "btn-color btn-excel"
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    // title: `${loggedInUserSchoolName} - program List`,
                    attr: {
                        class: "btn btn-sm btn-info rounded-right"
                    },
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    text: "Refresh",
                    attr: {
                        class: "btn-color btn-refresh"
                    },
                    action: function(e, dt, node, config) {
                        dt.ajax.reload(false, null);
                    }
                },

                {
                    text: "Add Bill Item",
                    attr: {
                        class: "btn-color btn-item"
                    },
                    action: function(e, dt, node, config) {
                        $('.add_product').toggle()
                    }
                },
            ]
        });
    </script>
@endsection
