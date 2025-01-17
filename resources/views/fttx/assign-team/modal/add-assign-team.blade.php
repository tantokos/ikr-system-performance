{{-- Modal Tambah Assign Tim --}}
<div class="modal fade" id="tambahAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Assign Tim FTTX</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('simpanSignTimFttx') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">No SO</span>
                                    <input class="form-control form-control-sm" value="{{ old('no_so') }}"
                                        type="text" id="no_so" name="no_so" style="border-color:#9ca0a7;"
                                        required>
                                </div>
                                <div class="col form-group mb-1">
                                    <span class="text-xs">WO Type</span>
                                    <select class="form-control form-control-sm" type="text" id="wo_type" name="wo_type" style="border-color:#9ca0a7;">
                                        <option value="">Pilih Type WO</option>
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
                                        <input class="form-control form-control-sm" type="text" id="pic_customer" name="pic_customer"
                                            style="border-color:#9ca0a7;" required value="{{ old('pic_customer') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">SO Date</span>
                                        <input class="form-control form-control-sm" type="text" id="so_date" name="so_date" style="border-color:#9ca0a7;"
                                            required value="{{ old('so_date') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Customer Name</span>
                                        <input class="form-control form-control-sm" type="text" id="customer_name" name="customer_name"
                                            style="border-color:#9ca0a7;" required value="{{ old('customer_name') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Phone PIC Cust</span>
                                        <input class="form-control form-control-sm" type="text" id="phone_pic_cust"
                                            name="phone_pic_cust" style="border-color:#9ca0a7;" required
                                            value="{{ old('phone_pic_cust') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Product</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="product" name="product"
                                        style="border-color:#9ca0a7;" required value="{{ old('product') }}">
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Lead Callsign</span>
                                        <select class="form-control form-control-sm" id="LeadCallsign"
                                            name="LeadCallsign" style="border-color:#9ca0a7;" required>
                                            <option value="">Pilih Lead Callsign</option>
                                            @if (isset($leadCallsign))
                                                @foreach ($leadCallsign as $lead)
                                                    <option
                                                        value="{{ $lead->lead_call_id . '|' . $lead->lead_callsign }}">
                                                        {{ $lead->lead_callsign }}
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Nama Leader</span>
                                        <input class="form-control form-control-sm" type="text" id="leader"
                                            name="leader" style="border-color:#9ca0a7;" readonly>
                                        <input type="hidden" id="leaderid" name="leaderid" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Callsign Tim</span>
                                <select class="form-control form-control-sm" id="callsignTimid" name="callsignTimid" style="border-color:#9ca0a7;"
                                    placeholder="Isi Callsign Tim" required>
                                    <option value="">Pilih Callsign Tim</option>
                                </select>
                                <input type="hidden" id="callsignTim" name="callsignTim">
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 1</span>
                                        <select class="form-control form-control-sm" id="teknisi1" name="teknisi1" style="border-color:#9ca0a7;" required>
                                            <option value="">Teknisi 1</option>
                                        </select>
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 2</span>
                                        <select class="form-control form-control-sm" id="teknisi2" name="teknisi2" style="border-color:#9ca0a7;" required>
                                            <option value="">Teknisi 2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 3</span>
                                        <select class="form-control form-control-sm" id="teknisi3" name="teknisi3" style="border-color:#9ca0a7;">
                                            <option value="">Teknisi 3</option>
                                        </select>
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Teknisi 4</span>
                                        <select class="form-control form-control-sm" id="teknisi4" name="teknisi4" style="border-color:#9ca0a7;">
                                            <option value="">Teknisi 4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="form-group mb-1">
                                <span class="text-xs">Address</span>
                                <textarea class="form-control form-control-sm" type="text" id="address" name="address"
                                    style="border-color:#9ca0a7;" required></textarea>
                            </div>
                        </div>

                        <div class="col">

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-0">
                                        <span class="text-xs">CID</span>
                                        <input type="text" class="form-control form-control-sm" type="text" id="cid" name="cid"
                                            style="border-color:#9ca0a7;" required value="{{ old('cid') }}">
                                    </div>
                                    <div class="col form-group mb-0">
                                        <span class="text-xs">Segment Sales</span>
                                        <input class="form-control form-control-sm" type="text" id="segment_sales"
                                            name="segment_sales" style="border-color:#9ca0a7;" required
                                            value="{{ old('segment_sales') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Checkin</span>
                                        <input type="text" class="form-control form-control-sm" type="text" id="checkin" name="checkin"
                                            style="border-color:#9ca0a7;" required value="{{ old('checkin') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Checkout</span>
                                        <input type="text" class="form-control form-control-sm" type="text" id="checkout" name="checkout"
                                            style="border-color:#9ca0a7;" required value="{{ old('checkout') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">Branch</span>
                                    <select class="form-control form-control-sm" type="text" id="branch" name="branch" style="border-color:#9ca0a7;"
                                        placeholder="Isi Callsign Tim">
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
                                    <input class="form-control form-control-sm" type="text" id="area" name="area" style="border-color:#9ca0a7;" required
                                        value="{{ old('area') }}">
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Status Penjadwalan</span>
                                <input type="text" class="form-control form-control-sm" type="text" id="status_penjadwalan" name="status_penjadwalan"
                                    style="border-color:#9ca0a7;" required value="{{ old('status_penjadwalan') }}">
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Jadwal IKR</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="jadwal_ikr" name="jadwal_ikr"
                                            style="border-color:#9ca0a7;" value="{{ old('jadwal_ikr') }}">
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Slot Time Jadwal</span>
                                        <select class="form-control form-control-sm" type="text" id="slot_time_jadwal" name="slot_time_jadwal" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim" required>
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
                            </div>

                            <div class="row">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Nopol</span>
                                    <input type="text" class="form-control form-control-sm" type="text" id="nopol" name="nopol"
                                        style="border-color:#9ca0a7;" required value="{{ old('nopol') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group mb-1">
                                    <span class="text-xs">Keterangan WO</span>
                                    <textarea class="form-control form-control-sm" type="text" id="keterangan_wo" name="keterangan_wo"
                                        style="border-color:#9ca0a7;"></textarea>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Remark For IKR</span>
                                        <textarea class="form-control form-control-sm" type="text" id="remark_for_ikr" name="remark_for_ikr"
                                            style="border-color:#9ca0a7;"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Remark EWO</span>
                                        <textarea class="form-control form-control-sm" type="text" id="remark_ewo" name="remark_ewo" style="border-color:#9ca0a7;"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="row text-center mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-dark align-items-center simpanDistribusi"
                                    id="simpanDistribusi">Simpan Data</button>
                                <button type="button" value="close" class="btn btn-sm btn-dark align-items-center"
                                    data-bs-dismiss="modal">Batalkan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- End Modal Tambah Assign Tim --}}
