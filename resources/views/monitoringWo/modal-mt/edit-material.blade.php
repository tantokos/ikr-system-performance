<div class="modal fade" id="editMaterial" tabindex="-1" aria-labelledby="exampleModalLabelMaterial" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabelMaterial">Edit Material</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateMaterialMt') }}" class="updateMaterialMt" method="POST" enctype="multipart/form-data">

                    @method('PUT')
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="status_item" class="col-form-label">Status Item:</label>
                                <select class="form-control form-control-sm"
                                    type="text" id="status_item" name="status_item"
                                    style="border-color:#9ca0a7;">
                                    <option value="" disabled selected>--Pilih Status Item--</option>
                                    <option value="OUT">OUT</option>
                                    <option value="IN">IN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="item_code" class="col-form-label">Item Code:</label>
                                <input type="hidden" id="det_id" name="detId">
                                <input type="text" class="form-control" name="item_code" id="item_code">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="qty" class="col-form-label">Qty:</label>
                                <input type="text" class="form-control" name="qty" id="qty">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="sn" class="col-form-label">SN:</label>
                                <input type="text" class="form-control" name="sn" id="sn">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="mac_address" class="col-form-label">Mac Address:</label>
                                <input type="text" class="form-control" name="mac_address" id="mac_address">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Description:</label>
                        <textarea class="form-control" name="description" id="description"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>
            </div>


        </div>
    </div>
</div>
