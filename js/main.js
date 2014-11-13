/**
 * Application JS
 */
(function() {

	var form = new ReptileForm('form');

	// Do something before validation starts
	form.on('beforeValidation', function() {
		$('body').append('<p>Before Validation</p>');
	});

	// Do something when errors are detected.
	form.on('validationError', function(e, err) {
		$('body').append('<p>Errors: ' + JSON.stringify(err) + '</p>');
	});

	// Do something after validation is successful, but before the form submits.
	form.on('beforeSubmit', function() {
		$('body').append('<p>Sending Values: ' + JSON.stringify(this.getValues()) + '</p>');
	});

	// Do something when the AJAX request has returned in success
	form.on('xhrSuccess', function(e, data) {
        if (data.redirect) {
            location.href = data.redirect;
        }
	});

	// Do something when the AJAX request has returned with an error
	form.on('xhrError', function(e, xhr, settings, thrownError) {
		$('body').append('<p>Submittion Error</p>');
	});

})();

// -- Views -- //

(function () {

    var createTable = function (headers, data) {
        var $headerRow = headers.reduce(function($acc, header){
            return $acc.append($('<th>').html(header.title));
        }, $('<tr>')).appendTo($('<thead>'));

        var $dataRows = data.reduce( function ($tbody, record) {
            return $tbody.append(
                headers.reduce(function ($row, header) {
                return $row.append($('<td>').html(record[header.key]));
            }, $('<tr>')));
        }, $('<tbody>'));

        var $table = $('<table>').append($headerRow).append($dataRows);
        return $table;
    };

    $('.table-model').each( function () {
        var tableData = JSON.parse($(this).html());
        $(this).after(createTable(tableData.headers, tableData.data));
    } );

}());

var camelToUnderscore = function($value) {
    return $value.replace(/([A-Z])/g, function($1){
        return '_'+$1.toLowerCase();
    });
};

// -- Actions -- //
$('table').on('click', 'button', function(e){
    if (!$(this).data('submit')) return;
    var url, obj = {};
    $.each($(this).data(), function(key, value){
        if (key === 'submit') url = value;
        else obj[camelToUnderscore(key)] = value;
    });
    $.post(url, obj)
    .done(function(data){
        var data_ = JSON.parse(data);
        if (data_.redirect) location.href = data_.redirect;
    })
    .fail(function(data){
        console.log('Update failed.');
    });
});
