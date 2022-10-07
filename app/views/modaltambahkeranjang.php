<style>
    .center {
        width: 150px;
        margin: 40px auto;

    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<?= csrf_field(); ?>

<?php
if ($tampildatakeranjang['kerjml'] == "") {
    $jumlahker = 1;
} else {
    $jumlahker = $tampildatakeranjang['kerjml'];
}
?>

<!-- Modal -->
<div class="modal fade" id="modalTambahKeranjang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahKeranjangLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahKeranjangLabel">Masukan Keranjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalKeranjang">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <img class="card-img rounded-0 img-fluid" src="<?= base_url() ?>/upload/<?= $tampilproduct['prodgambar'] ?>" width="50px" height="50px">
                    <div class="card-body">
                        <strong><?= $tampilproduct['prodnama'] ?></strong><br>
                        <?= $tampilproduct['prodtype'] ?>

                        <div class="form-group row">

                            <input type="hidden" class="form-control" name="kerbrgid" id="kerbrgid" value="<?= $tampilproduct['prodid'] ?>">
                            <input type="hidden" class="form-control" name="keruser" id="keruser" value="<?= session()->iduser ?>">
                            <input type="hidden" class="form-control" name="kertanggal" id="kertanggal" value="<?= date("Y-m-d") ?>">

                            <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="kerjml">
                                            <span class="glyphicon glyphicon-minus"><i class="fa fa-minus"></i></span>
                                        </button>
                                    </span>
                                    <input type="text" name="kerjml" id="kerjml" class="form-control input-number" value="<?= $jumlahker ?>" min="1" max="<?= $tampilproduct['prodstock'] ?>">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="kerjml">
                                            <span class="glyphicon glyphicon-plus"><i class="fa fa-plus"></i></span>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <button type="submit" id="tombolTambahKeranjang" class="btn btn-block btn-success btn-lg">Tambah ke Keranjang</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $('#closeModalKeranjang').click(function(e) {
        e.preventDefault();
        $('#modalTambahKeranjang').modal('hide');
        window.location.reload();
    });


    $('#tombolTambahKeranjang').click(function(e) {
        e.preventDefault();
        let kertanggal = $('#kertanggal').val();
        let kerbrgid = $('#kerbrgid').val();
        let kerjml = $('#kerjml').val();
        let keruser = $('#keruser').val();

        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/home/simpanKeranjang",
            data: {
                kertanggal: kertanggal,
                kerbrgid: kerbrgid,
                kerjml: kerjml,
                keruser: keruser,
            },
            dataType: "json",
            success: function(response) {

                if (response.sukses) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    });
</script>



<!-- untuk tombol tambah dan kurang -->
<script>
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>