<!-- Modal -->
<div class="modal fade" id="modalAddDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <?= form_open_multipart(base_url('product/simpandetail')) ?>

            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="staticBackdropLabel">Add Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">


                <input type="hidden" name="prodid" id="prodid" value="<?= $prodid ?>">

                <div class="form-group">
                    <label for="">Product</label>
                    <input type="text" name="prodnama" class="form-control" value="<?= $prodnama ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="">Type</label>
                    <input type="text" name="prodtype" class="form-control" value="<?= $prodtype ?>" readonly>
                </div>

                <div class="form-group">
                    <div class="custom-file">
                        <input type="file" class="form-control-file" id="prodgambar" name="prodgambar">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-success" id="tombolsimpan" autocomplete="off">Save</button>
                <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" id="batal">Cancel</button>
            </div>


            <?= form_close() ?>

        </div>
    </div>
</div>