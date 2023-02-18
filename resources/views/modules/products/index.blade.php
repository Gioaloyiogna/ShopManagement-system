@extends('layout.app')
@section('page-content')
    <div class="dashboard-menu">
        <div class="dashboard-header">
            <span>
                <h2 style="font-weight: bold;">Dashboard</h2>
            </span>
            <span><a href="" style="color:orangered;text-decoration:none">Home</a>/Products</span>
        </div>
        <div class="table-container ">
            <table class="content-table" id="product-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Product Quantity</th>
                        <th>Pack Price</th>
                        <th>Unit Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>


                </tbody>
            </table>
        </div>
    </div>
    @include('modules.products.modals.add_product')
    @include('modules.products.modals.update_product')
    <script>
        $('.cancel-modal').click(function(e) {
            e.preventDefault()
            $('.modal').hide()

        });
        var productTable = $('#product-table').DataTable({
            "lengthChange": false,
            dom: 'Bfrtip',
            ajax: {
                url: `${appUrl}/api/product/${shop_code}`,
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
                    data: "pack_price"
                },

                {
                    data: "unit_price"
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
                    text: "Add Product",
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
