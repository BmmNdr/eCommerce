let prodotti = [];

function addQuantity(val, id) {
    var quantity = parseInt(document.getElementById(id).innerHTML);
    quantity = quantity + val;

    if (quantity < 0) {
        quantity = 0;
    }

    document.getElementById(id).innerHTML = quantity;

    prodotti[id] = quantity;
}

function modifyQuantity() {
    $.ajax({
        url: "modifyQuantity.php",
        type: "POST",
        data: { prods: prodotti
        },
        success: function (data) {
            if(data != "ok") {
                window.location.href = "admin.php?err=Valori non validi";
            }
            else {
                window.location.href = "admin.php?msg=Quantità modificate con successo";
            }

        }});
}