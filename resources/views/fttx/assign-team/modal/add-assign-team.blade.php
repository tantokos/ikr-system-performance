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
                <form action="{{ route('simpanSignTim') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col form-group mb-1">
                                    <span class="text-xs">WO No</span>
                                    <input class="form-control form-control-sm" value="{{ old('noWo') }}"
                                        type="text" id="noWo" name="noWo" style="border-color:#9ca0a7;"
                                        required>
                                </div>

                                <div class="col-4 form-group mb-1">
                                    <span class="text-xs">Ticket No</span>
                                    <input class="form-control form-control-sm" type="text"
                                        value="{{ old('noWo') }}" id="ticketNo" name="ticketNo"
                                        style="border-color:#9ca0a7;">
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">WO Type</span>
                                        <input class="form-control form-control-sm" type="text" id="woType"
                                            name="woType" value="{{ old('woType') }}" style="border-color:#9ca0a7;">
                                    </div>
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Type</span>
                                        <select class="form-control form-control-sm" type="text" id="jenisWo"
                                            name="jenisWo" style="border-color:#9ca0a7;" value="{{ old('jenisWo') }}"
                                            required>
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
                                <input class="form-control form-control-sm" type="text" id="WoDate" name="WoDate"
                                    style="border-color:#9ca0a7;" required value="{{ old('WoDate') }}">
                            </div>


                            {{-- </div> --}}

                            {{-- <div class="col"> --}}

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col-4 form-group mb-1">
                                        <span class="text-xs">Cust Id</span>
                                        <input class="form-control form-control-sm" type="text" id="custId"
                                            name="custId" style="border-color:#9ca0a7;" required
                                            value="{{ old('custId') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Cust Name</span>
                                        <input class="form-control form-control-sm" type="text" id="custName"
                                            name="custName" style="border-color:#9ca0a7;" required
                                            value="{{ old('custName') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Cust Phone</span>
                                        <input class="form-control form-control-sm" type="text" id="custPhone"
                                            name="custPhone" style="border-color:#9ca0a7;" required
                                            value="{{ old('custPhone') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Cust Mobile</span>
                                        <input class="form-control form-control-sm" type="text" id="custMobile"
                                            name="custMobile" style="border-color:#9ca0a7;" required
                                            value="{{ old('custMobile') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Address</span>
                                <textarea class="form-control form-control-sm" type="text" id="custAddress" name="custAddress"
                                    style="border-color:#9ca0a7;" required></textarea>
                            </div>
                            <div class="form-group mb-1">
                                <span class="text-xs">Area/Cluster</span>
                                <input type="text" class="form-control form-control-sm" type="text"
                                    id="area" name="area" style="border-color:#9ca0a7;" required
                                    value="{{ old('area') }}">
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">IKR Date APK</span>
                                        <input class="form-control form-control-sm" type="date" id="ikrDateApk"
                                            name="ikrDateApk" style="border-color:#9ca0a7;" required
                                            value="{{ old('ikrDateApk') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Time APK</span>
                                        <select class="form-control form-control-sm" id="timeApk" name="timeApk"
                                            style="border-color:#9ca0a7;" placeholder="Isi Callsign Tim" required>
                                            <option value="">Pilih Time APK</option>
                                            <option value="09:00" {{ old('timeApk') == '09:00' ? 'selected' : '' }}>
                                                09:00</option>
                                            <option value="09:30" {{ old('timeApk') == '09:30' ? 'selected' : '' }}>
                                                09:30</option>
                                            <option value="10:00" {{ old('timeApk') == '10:00' ? 'selected' : '' }}>
                                                10:00</option>
                                            <option value="10:30" {{ old('timeApk') == '10:30' ? 'selected' : '' }}>
                                                10:30</option>
                                            <option value="11:00" {{ old('timeApk') == '11:00' ? 'selected' : '' }}>
                                                11:00</option>
                                            <option value="11:30" {{ old('timeApk') == '11:30' ? 'selected' : '' }}>
                                                11:30</option>
                                            <option value="12:00" {{ old('timeApk') == '12:00' ? 'selected' : '' }}>
                                                12:00</option>
                                            <option value="12:30" {{ old('timeApk') == '12:30' ? 'selected' : '' }}>
                                                12:30</option>
                                            <option value="13:00" {{ old('timeApk') == '13:00' ? 'selected' : '' }}>
                                                13:00</option>
                                            <option value="13:30" {{ old('timeApk') == '13:30' ? 'selected' : '' }}>
                                                13:30</option>
                                            <option value="14:00" {{ old('timeApk') == '14:00' ? 'selected' : '' }}>
                                                14:00</option>
                                            <option value="14:30" {{ old('timeApk') == '14:30' ? 'selected' : '' }}>
                                                14:30</option>
                                            <option value="15:00" {{ old('timeApk') == '15:00' ? 'selected' : '' }}>
                                                15:00</option>
                                            <option value="15:30" {{ old('timeApk') == '15:30' ? 'selected' : '' }}>
                                                15:30</option>
                                            <option value="16:00" {{ old('timeApk') == '16:00' ? 'selected' : '' }}>
                                                16:00</option>
                                            <option value="16:30" {{ old('timeApk') == '16:30' ? 'selected' : '' }}>
                                                16:30</option>
                                            <option value="17:00" {{ old('timeApk') == '17:00' ? 'selected' : '' }}>
                                                17:00</option>
                                            <option value="17:30" {{ old('timeApk') == '17:30' ? 'selected' : '' }}>
                                                17:30</option>
                                            <option value="18:00" {{ old('timeApk') == '18:00' ? 'selected' : '' }}>
                                                18:00</option>
                                            <option value="18:30" {{ old('timeApk') == '18:30' ? 'selected' : '' }}>
                                                18:30</option>
                                            <option value="19:00" {{ old('timeApk') == '19:00' ? 'selected' : '' }}>
                                                19:00</option>
                                            <option value="19:30" {{ old('timeApk') == '19:30' ? 'selected' : '' }}>
                                                19:30</option>
                                            <option value="20:00" {{ old('timeApk') == '20:00' ? 'selected' : '' }}>
                                                20:00</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">FAT Code</span>
                                        <input class="form-control form-control-sm" type="text" id="fatCode"
                                            name="fatCode" style="border-color:#9ca0a7;" required
                                            value="{{ old('fatCode') }}">
                                    </div>
                                    <div class="col-4 form-group mb-1">
                                        <span class="text-xs">Port FAT</span>
                                        <input class="form-control form-control-sm" type="text" id="portFat"
                                            name="portFat" style="border-color:#9ca0a7;" required
                                            value="{{ old('portFat') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <span class="text-xs">Remarks</span>
                                <textarea class="form-control form-control-sm" type="text" id="remarks" name="remarks"
                                    style="border-color:#9ca0a7;"></textarea>
                            </div>

                        </div>

                        <div class="col">
                            <div class="col form-group mb-1">
                                <span class="text-xs">Branch</span>
                                <select class="form-control form-control-sm" type="text" id="branch"
                                    name="branch" style="border-color:#9ca0a7;" placeholder="Isi Callsign Tim">
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
                                            value="{{ date('Y-m-d') }}" id="tglProgress" name="tglProgress"
                                            style="border-color:#9ca0a7;" value="{{ old('tglProgress') }}">
                                    </div>

                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Sesi</span>
                                        <select class="form-control form-control-sm" type="text" id="sesiShowAdd"
                                            name="sesiShowAdd" style="border-color:#9ca0a7;"
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
                                <div class="row">
                                    <div class="col form-group mb-1">
                                        <span class="text-xs">Slot Time</span>
                                        <select class="form-control form-control-sm" type="text" id="slotTime"
                                            name="slotTime" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim" required>
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
                                        <select class="form-control form-control-sm" id="callsignTimid"
                                            name="callsignTimid" style="border-color:#9ca0a7;"
                                            placeholder="Isi Callsign Tim" required>
                                            <option value="">Pilih Callsign Tim</option>
                                        </select>
                                        <input type="hidden" id="callsignTim" name="callsignTim">
                                    </div>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 1</span>
                                    <select class="form-control form-control-sm" id="teknisi1" name="teknisi1"
                                        style="border-color:#9ca0a7;" required>
                                        <option value="">Teknisi 1</option>
                                    </select>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 2</span>
                                    <select class="form-control form-control-sm" id="teknisi2" name="teknisi2"
                                        style="border-color:#9ca0a7;" required>
                                        <option value="">Teknisi 2</option>
                                    </select>
                                </div>

                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 3</span>
                                    <select class="form-control form-control-sm" id="teknisi3" name="teknisi3"
                                        style="border-color:#9ca0a7;">
                                        <option value="">Teknisi 3</option>
                                    </select>
                                </div>
                                {{-- </div> --}}
                                {{-- <div class="col"> --}}


                                <div class="form-group mb-1">
                                    <span class="text-xs">Teknisi 4</span>
                                    <select class="form-control form-control-sm" id="teknisi4" name="teknisi4"
                                        style="border-color:#9ca0a7;">
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
