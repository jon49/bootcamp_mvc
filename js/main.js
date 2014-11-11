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
		$('body').append('<p>Received Data: ' + JSON.stringify(data) + '</p>');
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
        }, $('<tr>')).appendTo($('<theader>'));

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


