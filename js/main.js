/**
 * Application JS
 */
(function() {

	var form = new ReptileForm('form');

	// Do something when the AJAX request has returned in success
	form.on('xhrSuccess', function(e, data) {
        if (data.redirect) {
            location.href = data.redirect;
        }
	});

	// Do something when the AJAX request has returned with an error
	form.on('xhrError', function(e, xhr, settings, thrownError) {
		$('body').append('<p>Submission Error</p>');
	});

})();

// -- Views -- //

(function () {

    var createTable = function (headers, data) {
        // create header row
        var $headerRow = headers.reduce(function($acc, header){
            return $acc.append($('<th>').html(header.title));
        }, $('<tr>')).appendTo($('<thead>'));

        // create data rows
        var $dataRows = data.reduce( function ($tbody, record) {
            return $tbody.append(
                headers.reduce(function ($row, header) {
                return $row.append($('<td>').html(record[header.key]));
            }, $('<tr>')));
        }, $('<tbody>'));

        // put the header and data rows together
        var $table = $('<table>').append($headerRow).append($dataRows);
        return $table;
    };

    // if script tag(s) with class of `table-model` exists
    // then create a table from the data after the script tags
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

    // make keys underscore values
    $.each($(this).data(), function(key, value){
        if (key === 'submit') url = value;
        else obj[camelToUnderscore(key)] = value;
    });
    // post from button
    $.post(url, obj)
    .done(function(data){
        var data_ = JSON.parse(data);
        if (data_.redirect) location.href = data_.redirect;
    })
    .fail(function(data){
        console.log('Update failed.');
    });
});
