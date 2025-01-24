<div class="modal fade" id="showAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Assign Tim FTTX</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateSignTimFttx') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col form-group mb-1">
                                    <input type="hidden" id="detId" name="detId">
                                    <span class="text-xs">No SO</span>
                                    <input class="form-control form-control-sm" type="text" id="noSo"
                                        name="no_so" style="border-color:#9ca0a7;">
                                </div>

                                <div class="col form-group mb-1">
                                    <span class="text-xs">WO Type</span>
                                    <select class="form-control form-control-sm" type="text" id="woType" name="wo_type"
                                        style="border-color:#9ca0a7;">
                                        <option value="">Pilih WO Type</option>
                                        <option value="FTTX New Installation">FTTX New Installation
                                        </option>
                                        <option value="FTTX Maintenance">FTTX Maintenance</option>
                                        <option value="FTTX/B New Installation">FTTX/B New Installation
                                        </option>
                                        <option value="FTTX/B Maintenance">FTTX/B Maintenance</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">PIC Customer</span>
                                        <input class="form-control form-control-sm" type="text" id="picCustomer"
                                            name="pic_customer" style="border-color:#9ca0a7;">
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">SO Date</span>
                                        <input class="form-control form-control-sm" type="text" id="soDate" name="so_date" style="border-color:#9ca0a7;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Customer Name</span>
                                        <input class="form-control form-control-sm" type="text" id="customerName"
                                            name="customer_name" style="border-color:#9ca0a7;">
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Phone PIC Cust</span>
                                        <input class="form-control form-control-sm" type="text" id="phonePicCust"
                                            name="phone_pic_cust" style="border-color:#9ca0a7;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Product</span>
                                        <input class="form-control form-control-sm" type="text" id="productShow"
                                            name="product" style="border-color:#9ca0a7;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Lead Callsign</span>
                                        <select class="form-control form-control-sm" id="LeadCallsignShow" name="LeadCallsignShow"
                                            style="border-color:#9ca0a7;" required>
                                            <option value="">Pilih Lead Callsign</option>
                                            @if (isset($leadCallsign))
                                                @foreach ($leadCallsign as $lead)
                                                    <option value="{{ $lead->lead_call_id . '|' . $lead->lead_callsign }}">
                                                        {{ $lead->lead_callsign }}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Nama Leader</span>
                                        <input class="form-control form-control-sm" type="text" id="leaderShow" name="leaderShow"
                                            style="border-color:#9ca0a7;" readonly>
                                        <input type="hidden" id="leaderidShow" name="leaderidShow" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Callsign Tim</span>
                                <select class="form-control form-control-sm" id="callsignTimidShow" name="callsignTimidShow"
                                    style="border-color:#9ca0a7;">
                                    <option value="">Pilih Callsign Tim</option>
                                </select>
                                <input type="hidden" id="callsignTimShow" name="callsignTimShow">
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 1</span>
                                        <select class="form-control form-control-sm" id="teknisi1Show" name="tim_1" style="border-color:#9ca0a7;">
                                            <option value="">Teknisi 1</option>
                                        </select>
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 2</span>
                                        <select class="form-control form-control-sm" id="teknisi2Show" name="tim_2" style="border-color:#9ca0a7;">
                                            <option value="">Teknisi 2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 3</span>
                                        <select class="form-control form-control-sm" id="teknisi3Show" name="tim_3" style="border-color:#9ca0a7;">
                                            <option value="">Teknisi 3</option>
                                        </select>
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 4</span>
                                        <select class="form-control form-control-sm" id="teknisi4Show" name="tim_4" style="border-color:#9ca0a7;">
                                            <option value="">Teknisi 4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Address</span>
                                <textarea class="form-control form-control-sm" type="text" id="addressShow" name="address"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Remark Ewo</span>
                                <textarea class="form-control form-control-sm" type="text" id="remarkEwo" name="remark_ewo"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>
                        </div>

                        <div class="col">

                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">CID</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="cidShow" name="cid"
                                        style="border-color:#9ca0a7;">
                                </div>
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Segment Sales</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="segmentSales" name="segment_sales"
                                        style="border-color:#9ca0a7;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Checkin</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="checkinShow" name="checkin"
                                        style="border-color:#9ca0a7;">
                                </div>
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Checkout</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="checkoutShow" name="checkout"
                                        style="border-color:#9ca0a7;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Branch</span>
                                    <select class="form-control form-control-sm" type="text" id="branchShow" name="branch"
                                        style="border-color:#9ca0a7;" placeholder="Isi Branch">
                                        <option value="">Pilih Branch</option>
                                        @if (isset($branches))
                                            @foreach ($branches as $b)
                                                <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                    {{ $b->nama_branch }}
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Area</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="areaShow" name="area"
                                        style="border-color:#9ca0a7;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Status Penjadwalan</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="statusPenjadwalan"
                                        name="status_penjadwalan" style="border-color:#9ca0a7;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Jadwal IKR</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="jadwalIkr" name="jadwal_ikr"
                                        style="border-color:#9ca0a7;">
                                </div>
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Slot Time Jadwal</span>
                                    <select class="form-control form-control-sm" type="text" id="slotTimeJadwal"
                                        name="slot_time_jadwal" style="border-color:#9ca0a7;"
                                        placeholder="Isi Callsign Tim">
                                        <option value="">Pilih Slot Time Jadwal</option>
                                        <option value="09:00">09:00</option>
                                        <option value="09:30">09:30</option>
                                        <option value="10:00">10:00</option>
                                        <option value="10:30">10:30</option>
                                        <option value="11:00">11:00</option>
                                        <option value="11:30">11:30</option>
                                        <option value="12:00">12:00</option>
                                        <option value="12:30">12:30</option>
                                        <option value="13:00">13:00</option>
                                        <option value="13:30">13:30</option>
                                        <option value="14:00">14:00</option>
                                        <option value="14:30">14:30</option>
                                        <option value="15:00">15:00</option>
                                        <option value="15:30">15:30</option>
                                        <option value="16:00">16:00</option>
                                        <option value="16:30">16:30</option>
                                        <option value="17:00">17:00</option>
                                        <option value="17:30">17:30</option>
                                        <option value="18:00">18:00</option>
                                        <option value="18:30">18:30</option>
                                        <option value="19:00">19:00</option>
                                        <option value="19:30">19:30</option>
                                        <option value="20:00">20:00</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Nopol</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="nopolShow" name="nopol"
                                        style="border-color:#9ca0a7;">
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Keterangan WO</span>
                                <textarea class="form-control form-control-sm" type="text" id="keteranganWo" name="keterangan_wo"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Remark For IKR</span>
                                <textarea class="form-control form-control-sm" type="text" id="remarkForIkr" name="remark_for_ikr"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>

                        </div>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="row text-center mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-dark align-items-center updateAssign"
                                    id="updateAssign">Edit Data</button>
                                <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                                    data-bs-dismiss="modal">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-white" data-bs-dismiss="modal">Close</button> --}}
                {{-- <button type="button" class="btn btn-dark">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>
