{{-- Modal Detail Material --}}
<div class="modal fade" id="showMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
    aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Detail Material</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-sm-12 mt-3 mb-3">
                    <div class="table-responsive p-0">
                        <table id="summaryAssignTeam"
                            class="table table-sm table-striped table-bordered align-items-center mb-0"
                            style="font-size: 12px;border-color:#9ca0a7;">
                            <thead class="bg-gray-600">
                                <tr id="headStatusProgresWo">
                                    <th class="text-white text-xs font-weight-semibold">No</th>
                                    <th class="text-white text-xs font-weight-semibold">Status Item</th>
                                    <th class="text-white text-xs font-weight-semibold">Item Code</th>
                                    <th class="text-white text-xs font-weight-semibold">Description</th>
                                    <th class="text-white text-xs font-weight-semibold">Qty</th>
                                    <th class="text-white text-xs font-weight-semibold">SN</th>
                                    <th class="text-white text-xs font-weight-semibold">Mac Address</th>
                                    <th class="text-white text-xs font-weight-semibold">Edit</th>
                                </tr>
                            </thead>
                            <tbody id="bodyStatusProgresWo">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                    data-bs-dismiss="modal">Tutup</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- End Modal Detail Material --}}
