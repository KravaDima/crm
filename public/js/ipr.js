/**
 * Сохранение информации о продукте
 */
function setProducts()
{
    var product = {
        'product_id': $('#product_id').val(),
        'product_name': $('#product_name').val(),
        'product_quantity': $('#product_quantity').val(),
        'product_price': $('#product_price').val()
    };

    $.ajax({
        type: "POST",
        url: "/products/set-product",
        // async: false,
        data: product,
        error: function (data) {
            alert("Ошибка при внесении информации о товаре");
        },
        success: function (data) {
            updateProductsList(data);

            $('#modal').modal('hide');
        }
    });
}

/**
 * Добавление котнрагента
 */
function setCounterparty()
{
    var counterparty = {
        'counterparty_type': $('#counterparty_type').val(),
        'counterparty_id': $('#counterparty_id').val(),
        'counterparty_name': $('#counterparty_name').val(),
        'counterparty_tel': $('#counterparty_tel').val(),
        'counterparty_email': $('#counterparty_email').val()
    }

    $.ajax({
        type: "POST",
        url: "/counterparty/set-counterparty",
        // async: false,
        data: counterparty,
        error: function (data) {
            alert("Ошибка при внесении информации о контрагенте");
        },
        success: function (data) {
            updateCounterpartyList(data);

            $('#modal').modal('hide');

        }
    });
}

/**
 * Редактирование продукта
 */
function editProduct(id)
{
    $.ajax({
        type: "POST",
        url: "/products/edit-product",
        // async: false,
        data: {
            id: id
        },
        error: function (data) {
            alert("Ошибка при редактировании товара");
        },
        success: function (data) {
            $('#product_id').val(data.id);
            $('#product_name').val(data.name);
            $('#product_quantity').val(data.quantity);
            $('#product_price').val(data.price);

        }
    });
}

/**
 * Редактирование контрагента
 */
function editCounterparty(id)
{
    $.ajax({
        type: "POST",
        url: "/counterparty/edit-counterparty",
        // async: false,
        data: {
            id: id
        },
        error: function (data) {
            alert("Ошибка при редактировании контрагента");
        },
        success: function (data) {
            $('#counterparty_id').val(data.id);
            $('#counterparty_name').val(data.name);
            $('#counterparty_type').val(data.type);
            $('#counterparty_tel').val(data.tel);
            $('#counterparty_email').val(data.email);

        }
    });
}

/**
 * Удаление продукта
 */
function delProduct(id)
{
    $.ajax({
        type: "POST",
        url: "/products/del-product",
        // async: false,
        data: {
            id: id,
        },
        error: function (data) {
            alert("Ошибка при удалении товара");
        },
        success: function (data) {
            updateProductsList(data);
        }
    });
}

/**
 * Удаление контрагента
 */
function delCounterparty(id)
{
    $.ajax({
        type: "POST",
        url: "/counterparty/del-counterparty",
        // async: false,
        data: {
            id: id,
        },
        error: function (data) {
            alert("Ошибка при удалении товара");
        },
        success: function (data) {
            updateCounterpartyList(data);
        }
    });
}

/**
 * Обновление списка всех продуктов для формирования таблицы товаров
 */
function updateProductsList(data)
{
    $('#all-product-tab').empty();
    // console.log(data);
    $.each(data, function(i, item) {

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct( ' + item.id + ')">'
                    + '<i class="fa fa-pencil" aria-hidden="true"></i>'
                + '</a>'
                + '<a class="col-md-offset-3" href="#" onclick="delProduct( ' + item.id + ')">'
                    + '<i class="fa fa-trash-o fa-lg"></i>'
                + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-product-tab').append(stringTab);
    });
}

/**
 * Обновление списка контрагентов
 */
function updateCounterpartyList(data)
{
    $('#all-counterparty-tab').empty();

    $.each(data, function(i, item) {
        var itemType = ''
        item.type == 1 ? itemType = '<td class="btn-danger">Покупатель</td>' : '';
        item.type == 2 ? itemType = '<td class="btn-success">Поставщик</td>' : '';

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + itemType
            + '<td>' + item.name + '</td>'
            + '<td>' + item.tel + '</td>'
            + '<td>' + item.email + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editCounterparty( ' + item.id + ')">'
            + '<i class="fa fa-pencil" aria-hidden="true"></i>'
            + '</a>'
            + '<a class="col-md-offset-3" href="#" onclick="delCounterparty( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-counterparty-tab').append(stringTab);
    });
}

/**
 * Очистка модального окна продуктов
 */
function clearProductModal()
{
    $('#product_id').val('');
    $('#product_name').val('');
    $('#product_quantity').val('');
    $('#product_price').val('');
}

/**
 * очистка модального окна в контрагентах
 */
function clearCounterpartyModal()
{
    $('#counterparty_type').val('');
    $('#counterparty_id').val('');
    $('#counterparty_name').val('');
    $('#counterparty_tel').val('');
    $('#counterparty_email').val('');
}

/**
 * Получение списка всех товаров
 */
function getAllProduct()
{
    $.ajax({
        type: "POST",
        url: "/products/get-all-products",
        // async: false,
        // data: product,
        error: function (data) {
            alert("Ошибка при получении информации о всех товарах");
        },
        success: function (data) {
            updateProductsListInModal(data);
        }
    });
}

/**
 * Обновление таблицы с товарами в модальном окне в приходной накладной
 */
function updateProductsListInModal(data)
{
    $('#all-product-tab').empty();
    // console.log(data);
    $.each(data, function(i, item) {

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center">'
            + '<a href="#" onclick="addProductIncomingOrder( ' + item.id + ')">'
            + '<i class="fa fa-plus fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-product-tab').append(stringTab);
    });
}

/**
 * Добавление товара в приходную накладную
 */
function addProductIncomingOrder(id)
{
    $.ajax({
        type: "POST",
        url: "/products/add-product-incoming",
        data : {
            product_id: id,
            // order_id: $('#incoming_payment_order_id').val(),
            order_id: 1,
            counterparty_id: $('#counterparty_id').val(),
        },
        error: function (data) {
            alert("Ошибка при добавлении товара в приходную накладную");
        },
        success: function (data) {

            updateProductsListInModal(data);
        }
    });
}




