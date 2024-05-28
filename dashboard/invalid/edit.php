<!-- SignIn modal content -->
<div id="modalEdit-<?= $data["id"]; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header px-3">
                <h4 class="modal-title" id="myCenterModalLabel">Ubah Status Surat <strong><?= $data['nomor']; ?></strong></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="proses/proses_edit.php?id=<?= $data["id"]; ?>" class="needs-validation" novalidate>

                <div class="modal-body">

                    <div class="mb-3 px-3">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option selected disabled>Pilih status...</option>
                            <?php
                            $statuses = [1 => 'Pending', 2 => 'Valid', 3 => 'Tidak Valid'];
                            $selectedStatus = isset($_POST['status']) ? $_POST['status'] : $data['status'];

                            foreach ($statuses as $value => $option) {
                                $selected = ($selectedStatus == $value) ? 'selected' : '';
                                echo '<option value="' . htmlspecialchars($value) . '" ' . $selected . '>' . htmlspecialchars($option) . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer mb-3 px-3">
                        <button class="btn btn-sm btn-primary mt-2" type="submit" name="Edit"><i class="mdi mdi-pencil"></i> Edit</button>
                    </div>



                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->