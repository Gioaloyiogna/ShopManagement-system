<div class="modal edit_product" id="update_product">
    <div class="modal-header">
        <h3>Update product <i class='bx bx-edit'></i></h3>
    </div>
    <div class="modal-body">
        <form action="" method="post" id="edit_product_form">
            @csrf
            <div class="form-group align-btn">
                <input type="hidden" name="product_code" id="edit_product_code" value="">
                <label for="">Product name:</label>
                <input type="text" name="product_name" id="edit_product_name" placeholder="">
            </div>
            <div class="form-group align-btn">
                <label for="">Product quantity:</label>
                <input type="text" name="product_quantity" id="edit_product_quantity" placeholder="">
            </div>
            <div class="form-group align-btn">
                <label for="">Pack price:</label>
                <input type="text" name="pack_price" id="edit_pack_price" placeholder="">
            </div>
            <div class="form-group align-btn ">
                <label for="">Unit price:</label>
                <input type="text" name="unit_price" id="edit_unit_price" placeholder="">
            </div>

            <div class="modal-buttons">
                <button class="cancel-modal">Cancel</button>
                <button id="submit-edit-modal" class="submit-modal" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    //updating prices
    $("#product-table").on("click", ".table-edit-btn", function() {
        $("#update_product").toggle()
        var data = productTable.row($(this).parents('tr')).data()
        $("#edit_product_name").val(data.product_name)
        $("#edit_product_quantity").val(data.product_quantity)
        $("#edit_unit_price").val(data.unit_price)
        $("#edit_pack_price").val(data.pack_price)
        $("#edit_product_code").val(data.product_code)

    })
    let editProductForm = document.querySelector("#edit_product_form")
    $("#edit_product_form").submit(function(e) {
        e.preventDefault()
        var formdata = new FormData(editProductForm)
        formdata.append("shop_code", `${shop_code}`)
        $("#update_product").hide()
        Swal.fire({
            title: "Are you sure you want to update product?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4BB543",
            confirmButtonText: "Update"
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    text: "Updating product please wait...",
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                fetch(`${appUrl}/api/product/updateProduct`, {
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
                        text: "Product updated successfully",
                        type: "success"
                    });
                    productTable.ajax.reload(false,null)
                }).catch(function(err) {
                    if (err) {
                        Swal.fire({
                            text: "Updating product failed"
                        });
                    }
                })
            }
        })
    })
</script>
