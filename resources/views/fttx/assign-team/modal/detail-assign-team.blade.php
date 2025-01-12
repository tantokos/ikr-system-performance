<div class="modal fade" id="showAssignTim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Assign Tim</h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('updateSignTim') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col form-group mb-1">
                                    <input type="hidden" id="detId" name="detId">
                                    <span class="text-xs">WO No</span>
                                    <input class="form-control form-control-sm" type="text" id="noWoShow"
                                        name="noWoShow" style="border-color:#9ca0a7;">
                                </div>

                                <div class="col-4 form-group mb-1">
                                    <span class="text-xs">Ticket No</span>
                                    <input class="form-control form-control-sm" type="text" id="ticketNoShow"
                                        name="ticketNoShow" style="border-color:#9ca0a7;">
                                </div>


                            </div>



                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">WO Type</span>
                                        <input class="form-control form-control-sm" type="text" id="woTypeShow"
                                            name="woTypeShow" style="border-color:#9ca0a7;">
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Type</span>
                                        <select class="form-control form-control-sm" type="text" id="jenisWoShow"
                                            name="jenisWoShow" style="border-color:#9ca0a7;">
                                            <option value="FTTX New Installation">FTTX New Installation
                                            </option>
                                            <option value="FTTX Maintenance">FTTX Maintenance</option>
                                            <option value="FTTX/B New Installation">FTTX/B New Installation
                                            </option>
                                            <option value="FTTX/B Maintenance">FTTX/B Maintenance</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">WO Date</span>
                                <input class="form-control form-control-sm" type="text" id="WoDateShow"
                                    name="WoDateShow" style="border-color:#9ca0a7;">
                            </div>


                            {{-- </div> --}}

                            {{-- <div class="col"> --}}

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col-4 form-group mb-1">
                                        <span class="text-xs">Cust Id</span>
                                        <input class="form-control form-control-sm" type="text" id="custIdShow"
                                            name="custIdShow" style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Cust Name</span>
                                        <input class="form-control form-control-sm" type="text" id="custNameShow"
                                            name="custNameShow" style="border-color:#9ca0a7;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Cust Phone</span>
                                        <input class="form-control form-control-sm" type="text" id="custPhoneShow"
                                            name="custPhoneShow" style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Cust Mobile</span>
                                        <input class="form-control form-control-sm" type="text" id="custMobileShow"
                                            name="custMobileShow" style="border-color:#9ca0a7;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Address</span>
                                <textarea class="form-control form-control-sm" type="text" id="custAddressShow" name="custAddressShow"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>
                            <div class="form-group mb-1">
                                <span class="text-xs">Area/Cluster</span>
                                <input type="text" class="form-control form-control-sm" type="text"
                                    id="areaShow" name="areaShow" style="border-color:#9ca0a7;">
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">FAT Code</span>
                                        <input class="form-control form-control-sm" type="text" id="fatCodeShow"
                                            name="fatCodeShow" style="border-color:#9ca0a7;">
                                    </div>
                                    <div class="col-4 form-group mb-1">
                                        <span class="text-xs">Port FAT</span>
                                        <input class="form-control form-control-sm" type="text" id="portFatShow"
                                            name="portFatShow" style="border-color:#9ca0a7;">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Remarks</span>
                                <textarea class="form-control form-control-sm" type="text" id="remarksShow" name="remarksShow"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>

                        </div>

                        <div class="col">




                            <div class="col form-group mb-1">
                                <span class="text-xs">Branch</span>
                                <select class="form-control form-control-sm" type="text" id="branchShow"
                                    name="branchShow" style="border-color:#9ca0a7;" placeholder="Isi Callsign Tim">
                                    <option value="">Pilih Branch</option>
                                    @if (isset($branches))
                                        @foreach ($branches as $b)
                                            <option value="{{ $b->id . '|' . $b->nama_branch }}">
                                                {{ $b->nama_branch }}
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Tanggal Progress</span>
                                        <input class="form-control form-control-sm" type="date"
                                            value="{{ date('Y-m-d') }}" id="tglProgressShow" name="tglProgressShow"
                                            style="border-color:#9ca0a7;">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Sesi</span>
                                        <select class="form-control form-control-sm" type="text" id="sesiShow"
                                            name="sesiShow" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="Regular">Regular</option>
                                            <option value="Batch 1">Batch 1</option>
                                            <option value="Batch 2">Batch 2</option>
                                            <option value="Batch 3">Batch 3</option>
                                            <option value="Batch 4">Batch 4</option>
                                            <option value="Batch 5">Batch 5</option>
                                            <option value="Batch 6">Batch 6</option>
                                            <option value="Pendingan">Pendingan</option>
                                            <option value="Sameday">Sameday</option>

                                        </select>
                                    </div>



                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">


                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Lead Callsign</span>
                                        <select class="form-control form-control-sm" id="LeadCallsignShow"
                                            name="LeadCallsignShow" style="border-color:#9ca0a7;" required>
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
                                        <input class="form-control form-control-sm" type="text" id="leaderShow"
                                            name="leaderShow" style="border-color:#9ca0a7;" readonly>
                                        <input type="hidden" id="leaderidShow" name="leaderidShow" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Slot Time</span>
                                        <select class="form-control form-control-sm" type="text" id="slotTimeShow"
                                            name="slotTimeShow" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim">
                                            <option value="">Pilih Slot Time</option>
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

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Callsign Tim</span>
                                        <select class="form-control form-control-sm" id="callsignTimidShow"
                                            name="callsignTimidShow" style="border-color:#9ca0a7;">
                                            <option value="">Pilih Callsign Tim</option>
                                        </select>
                                        <input type="hidden" id="callsignTimShow" name="callsignTimShow">
                                    </div>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 1</span>
                                    <select class="form-control form-control-sm" id="teknisi1Show"
                                        name="teknisi1Show" style="border-color:#9ca0a7;">
                                        <option value="">Teknisi 1</option>
                                    </select>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 2</span>
                                    <select class="form-control form-control-sm" id="teknisi2Show"
                                        name="teknisi2Show" style="border-color:#9ca0a7;">
                                        <option value="">Teknisi 2</option>
                                    </select>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 3</span>
                                    <select class="form-control form-control-sm" id="teknisi3Show"
                                        name="teknisi3Show" style="border-color:#9ca0a7;">
                                        <option value="">Teknisi 3</option>
                                    </select>
                                </div>
                                {{-- </div> --}}
                                {{-- <div class="col"> --}}


                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 4</span>
                                    <select class="form-control form-control-sm" id="teknisi4Show"
                                        name="teknisi4Show" style="border-color:#9ca0a7;">
                                        <option value="">Teknisi 4</option>
                                    </select>
                                </div>
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
