<div class="modal fade" id="form_product" tabindex="-1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h2 " id="ModalTitle" onclick="fetchList('product_category');" >Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" style="color:white;">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product-form" onsubmit="return false">
                    <!-- <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="date">Added Date</label>
                            <input type="text" class="form-control" id="added-date" name="added-date"
                                value="<?php date_default_timezone_set("Asia/Kathmandu"); echo date("Y-m-d h:i");?>" readonly>
                        </div>
                    </div> -->

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="hidden" name="id" id="id" value=""/>

                            <label for="name">Product Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Product Name">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="select_category">Category</label>
                            <select id="select_category" name="select_category" class="form-control" required>
                                <option selected>Choose...</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="select_vendor">Vendor</label>
                            <select id="select_vendor" name="select_vendor" class="form-control" required>
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="selling_price">Selling Price</label>
                            <input type="number" min=0 class="form-control" id="selling_price" name="selling_price"
                                placeholder="Rs. 1000">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="cost_price">Cost Price</label>
                            <input type="number" min=0 class="form-control" id="cost_price" name="cost_price"
                                placeholder="Rs. 1000">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="stock">Stock</label>
                            <input type="number" min=0 class="form-control" id="stock" name="stock"
                                placeholder="Rs. 1000">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check position-relative fixed-bottom">
                            <input class="form-check-input" type="checkbox" value="" id="isActive" name="isctive" checked>
                            <label class="form-check-label" for="active">
                                Active Product
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <small id="msg-product" class="form-text text-muted"></small>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="Add" id="btn_submit">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>