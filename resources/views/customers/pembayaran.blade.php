<!-- Detail Kendaraan -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Detail Kendaraan
                        </h5>

                        <div class="mb-3">

                            <label class="form-label">
                                Nomor Polisi
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                placeholder="Contoh: H 1234 AB">

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Jenis Kendaraan
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="detailKendaraan"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Slot Parkir
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="detailNamaSlot"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Area Parkir
                            </label>

                            <input
                                type="text"
                                class="form-control"
                                id="detailArea"
                                readonly>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Durasi Parkir
                            </label>

                            <select class="form-select">

                                <option>1 Jam</option>
                                <option>2 Jam</option>
                                <option>3 Jam</option>
                                <option>4 Jam</option>
                                <option>5 Jam</option>

                            </select>

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Tanggal Masuk
                            </label>

                            <input
                                type="date"
                                class="form-control">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">
                                Jam Masuk
                            </label>

                            <input
                                type="time"
                                class="form-control">

                        </div>

                        <div class="border rounded-3 p-3 bg-label-primary mb-4">

                            <small class="text-body-secondary d-block">
                                Estimasi Tarif
                            </small>

                            <h4
                                class="fw-bold text-primary mb-0"
                                id="detailTarif">

                                Rp 5.000

                            </h4>

                        </div>

                        <button
                            class="btn btn-primary w-100"
                            id="btnReservasi"
                            disabled>

                            <i class="mdi mdi-arrow-right-circle-outline me-1"></i>
                            Lanjutkan Reservasi

                        </button>

                    </div>

                </div>

            </div>