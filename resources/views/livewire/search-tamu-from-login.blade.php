<div class="modal fade" wire:ignore.self id="ModalUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">>

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keprluan Tamu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form wire:submit.prevent="save">
                    {{ csrf_field() }}

                    <div class="mb-3" wire:ignore>
                        <label for="keperluan" class="form-label">Keperluan</label>
                        <select class="keperluan" name="keperluan[]" id="keperluan" multiple="multiple" style="width: 100%;">
                            <option value="Penarikan Server">Penarikan Server</option>
                            <option value="Pemasangan Server">Pemasangan Server</option>
                            <option value="Maintenance Server">Maintenance Server</option>
                        </select>
                    </div>
                    <div class="mb-3" wire:ignore>
                        <label for="rak" class="form-label">Rak</label>
                        <select class="rak" name="rak[]" id="rak" multiple="multiple" style="width: 100%;">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <button type="button" id="cancel" class="btn btn-secondary cencel" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary @if(empty($rak) && empty($keperluan)) disabled @endif">Save</button>
                </form>
            </div>
        </div>

    </div>
    <script>
        document.addEventListener('livewire:load', function() {

            document.addEventListener('click', (event) => {
                if (event.target.id === 'cancel' || event.target.className === 'btn-close') {
                    $('#keperluan').val(null).trigger('change');
                    $('#rak').val(null).trigger('change');
                };
            })

            $('#keperluan').select2({
                dropdownParent: $('#ModalUpdate'),
                placeholder: "Keperluan",
                allowClear: true,
                tags: true
            }).on('change', function() {
                let data = $('#keperluan').select2("val");
                @this.set('keperluan', data)
            });
            $('#rak').select2({
                dropdownParent: $('#ModalUpdate'),
                placeholder: "Rak",
                allowClear: true,
                tags: true
            }).on('change', function() {
                let data = $('#rak').select2("val");
                @this.set('rak', data)
            });
        })
    </script>
</div>