// cek kesiapan halaman
// supaya script js bisa ditaruh di head
$(document).ready(function () {

    // event ketika tombol cari ditulis
    $('#keyword').on('keyup', function () {


        //pengganti fungsi ajax menggunakan jquery
        //$('#container').load('ajax/buku.php?keyword=' + $('#keyword').val());

        //show loader.gif
        $('.loader').show();

        //menggunakan $.get() = supaya bisa kasi sesuatu di dalamnya
        $.get('ajax/buku.php?keyword=' + $('#keyword').val(), function (data) {

            $('#container').html(data);

            //hide loader.gif
            $('loader').hide();
        });

    });

});