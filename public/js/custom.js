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


//
Transaksi
var items = []
var diskon = 0
var total = 0
var gtotal = 0
var tarif_layanan = 0
var tax = 0

function addMenu(menu){
    // Menu yang dipilih
    let rsMenu = JSON.parse(menu)
    // Cek Menu di dalam variable items
    cekMenu = items.filter((menu) => menu.id_menu == rsMenu.id)
    
    if(cekMenu.length==0){
        // Jika belum ada maka data di tambahkan ke variable items
        dtMenu = {
            "id_menu" : rsMenu.id,
            "kd_menu" : rsMenu.kd_menu,
            "nm_menu" : rsMenu.nm_menu,
            "harga_menu" : rsMenu.harga_menu,
            "jumlah_menu" : 1
        }
        items.push(dtMenu) // Menambahkan data ke variable items
    } else {
        // Jika sudah ada maka update jumlah
        idxItem = items.findIndex((menu => menu.id_menu == rsMenu.id))
            items[idxItem].jumlah_menu += 1
    }
    
    listMenu()
    
    console.log(items)
    
}

function updateJumlah(e){
    idxMenu = $(e).parent().parent().attr("idx")
    // Tombol Minus
    if($(e).hasClass('input-group-prepend')){
        if(items[idxMenu].jumlah_menu > 1){ items[idxMenu].jumlah_menu -= 1 }
    }
    // Tombol Plus
    if($(e).hasClass('input-group-append')){
        items[idxMenu].jumlah_menu += 1
    }
    // Ketika input di update nilai jumlahnya
    if($(e).hasClass('jumlah')){
        n = parseInt($(e).val())
        items[idxMenu].jumlah_menu = n <= 0 ? 1 : n
    }

    listMenu()
}

function listMenu(){
    $(".order-list").html("") // Menghapus HTML pada div dengan class .order-list
    items.map((rsMenu,index) => {
        content = $("#template").clone()
        content.removeClass('d-none')
        content.attr("idx",index)
        content.attr("id",rsMenu.id_menu)
        content.find(".nm_menu").html(rsMenu.nm_menu)
        content.find(".qty_menu").find("input").val(rsMenu.jumlah_menu)
        content.find(".price_menu").html((rsMenu.harga_menu*rsMenu.jumlah_menu).toLocaleString('id-ID'))
        
        $(".order-list").append(content)
    })
    
    updateTotal()

}
    function updateTotal(){
    total = 0
    // Menghitung total pesanan
    items.map((rsMenu) => {
    total += (rsMenu.harga_menu * rsMenu.jumlah_menu)
    })
    
    total_diskon = total - diskon
    tarif_layanan = total_diskon * (5/100)
    tax = (total_diskon + tarif_layanan) * (10/100)
    gtotal = total_diskon + tax

    $("#total").html(total.toLocaleString('id-ID'))
    $("#diskon").html(Math.round(diskon).toLocaleString('id-ID'))
    $("#tax").html(Math.round(tax).toLocaleString('id-ID'))
    $("#gtotal").html(Math.round(gtotal).toLocaleString('id-ID'))
}