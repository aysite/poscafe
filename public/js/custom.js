// Custom JS

$(document).ready(function(){
    $('.tbData').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,      
    })

    // Klik Gambar Menu
    $("#foto_menu").click(function () {
        $("#file_foto").click();
    })

    // Ketika file input change
    $("#file_foto").change(function () {
        setImage(this, "#foto_menu");
    })

    // Klik Foto User
    $("#foto").click(function () {
        $("#file_foto").click();
    })
    
    // Ketika file input change
    $("#file_foto").change(function(){
        setImage(this, "#foto");
    })
})

// Read Image
function setImage(input, target) {
    if (input.files && input.files[0]){
        var reader = new FileReader()

        // Mengganti src dari object image#avatar
        reader.onload = function (e) {
            $(target).attr('src', e.target.result)
            console.log(e.target.result)
        }

        reader.readAsDataURL(input.files[0])
    }
}



// Handle Form Table
function setFormTable(mode,data=null){

    $("#frm_Table")[0].reset()

    if(mode=="Edit"){
        rsTable = JSON.parse(data)

        $("#id_table").val(rsTable.id)
        $("#no_table").val(rsTable.no_table)
        $("#capacity_table").val(rsTable.capacity_table)
        $("#status_table").val(rsTable.status_table)
    }

    $("$mode").html(mode)
    $("$modal-meja").modal('show')
    console.log(rsTable.id)
}