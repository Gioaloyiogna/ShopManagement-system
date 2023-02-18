<div class="modal add_product" id="add_product">
    <div class="modal-header" >
        <h3>Add product <i class='bx bx-edit'></i></h3>
    </div>
    <div class="modal-body">
        <form action="" method="post" id="add_product_form">
            @csrf
            <div class="form-group align-btn">
                <label for="">Product name:</label>
                <input type="text" name="product_name" id="" placeholder="">
            </div>
            <div class="form-group align-btn">
                <label for="">Product weight:</label>
                <input type="text" name="product_weight" id="" placeholder="">
            </div>
            <div class="form-group align-btn">
                <label for="">Pack price:</label>
                <input type="text" name="pack_price" id="" placeholder="">
            </div>
            <div class="form-group align-btn ">
                <label for="">Unit price:</label>
                <input type="text" name="unit_price" id="" placeholder="">
            </div>
            <div class="form-group align-btn">
                <label for="">Total product quantity:</label>
                <input type="text" name="product_quantity" id="" placeholder="">
            </div>
            <div class="modal-buttons">
                <button class="cancel-modal">Cancel</button>
                <button id="submit-modal" class="submit-modal" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<script>
    let productForm = document.getElementById('add_product_form')
    $('#add_product_form').submit(function(e) {
        e.preventDefault()
        let formdata = new FormData(productForm)
        formdata.append('shop_code', `${shop_code}`)
        formdata.append('user_id', `${user_id}`)
        $('.modal').hide()

        Swal.fire({
            title: 'Are you sure you want to add product?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Add',
        }).then(function(result) {
            if (result.value) {
                Swal.fire({
                    text: "Adding product please wait...",
                    showConfirmButton: false,
                    allowEscapeKey: false,
                    allowOutsideClick: false
                });
                fetch(`${appUrl}/api/product/add`, {
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
                        text: "Product added  successfully",
                        type: "success"
                    });
                    productTable.ajax.reload(false, null);
                    productForm.reset();
                }).catch(function(err) {
                    if (err) {

                        Swal.fire({
                            text: "Adding product failed"
                        });
                    }
                })
            }
        })
    })
</script>
