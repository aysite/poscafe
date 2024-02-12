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


// Transaksi
var kd_cus = 0
var nm_cus = "General"
var id_meja = 0
var jns_layanan = "Dine In"
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
    
    total_diskon = total - (Math.round(diskon * total))
    tarif_layanan = total_diskon * (5/100)
    tax = (total_diskon + tarif_layanan) * (10/100)
    gtotal = total_diskon + tax

    $("#total").html(total.toLocaleString('id-ID'))
    $("#diskon").html(Math.round(diskon*total).toLocaleString('id-ID'))
    $("#tax").html(Math.round(tax).toLocaleString('id-ID'))
    $("#gtotal").html(Math.round(gtotal).toLocaleString('id-ID'))
}


function delMenu(e){
    idxMenu = $(e).parent().attr("idx")

    items.splice(idxMenu,1)

    listMenu()
}

function setCustomer (customer){
    rsCustomer = JSON.parse(customer)
    
    // Set Nama Customer
    $("#nm_customer").html(rsCustomer.nm_cus)

    kd_cus = rsCustomer.kd_cus
    nm_cus = rsCustomer.nm_cus
    if(kd_cus==0){ diskon = 0} else { diskon = 0.05 }
    if(items.length > 0){ updateTotal() }

    // Set Nama Customer
    if(kd_cus==0){
        $("#tnm_customer").val("")
        $("#tnm_customer").fadeIn()
    } else {
        $("#tnm_customer").fadeOut()
    }
    
    // Close Modal
    $('#modal-customer').modal('hide')
}

function setNamaCustomer(e){
    nm_cus = $(e).val()
    console.log(nm_cus)
}

function setLayanan (layanan){
    if(layanan=="Take Away"){
        $("#layanan").html(layanan)
        jns_layanan = "Take Away"
    } else {
        rsMeja = JSON.parse(layanan)
        $("#layanan").html("Meja#"+rsMeja.no_table)
        jns_layanan = "Dine In"
        id_meja = rsMeja.id
    }

    // Close Modal
    $('#modal-meja').modal('hide')
}

function saveTrans(){
    // Validasi
    if(items.length==0){
        alert('Maaf Menu Masih Kosong !')
        return false;
    }
    if(jns_layanan=="Dine In" && id_meja == 0){
        alert('Maaf Meja Belum di pilih !')
        return false;
    }
    
    // Data Simpan
    data_store = {
    "kd_cus"   : kd_cus,
    "nm_cus"   : nm_cus, 
    "id_meja"  : id_meja,
    "layanan"  : jns_layanan,
    "gtotal"   : gtotal,
    "diskon"   : diskon,
    "blayanan" : tarif_layanan,
    "tax"      : tax,
    "_token"   : $("#detail").attr('csrf'),
    "detail"   : items // Data Menu yang di Pesan
}
    
    $.ajax({
        beforeSend:function(){
            $("#loader").css("display","flex").fadeIn()
    },
        type: 'POST',
        dataType:'json',
        url:$("#detail").attr('url'),
        data:data_store,
        success:function(data) {
            console.log(data) 
            if(data.status==200){
                resetTrans()
                $("#loader").fadeOut(function(){
                alert(data.text)
                })
            }
        },
        error: function(data){
            console.log(data)
        }
    })
}

    function resetTrans(){
    kd_cus = 0
    nm_cus = "General Customer"
    id_meja = 0
    jns_layanan = "Dine In"
    items = []
    diskon = 0
    total = 0
    gtotal = 0
    tarif_layanan = 0
    tax = 0 

    $("#tnm_customer").val("")
    $("#nm_customer").html(nm_cus)
    $("#layanan").html(jns_layanan)
    $(".order-list").html('')
    $("#total").html(0)
    $("#diskon").html(0)
    $("#tax").html(0)
    $("#gtotal").html(0)
}