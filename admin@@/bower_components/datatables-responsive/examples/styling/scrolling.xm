<?xml version="1.0" encoding="UTF-8" ?>
<dt-example table-type="html-wide" table-class="display nowrap" order="3">

<css lib="datatables responsive">
	div.container { max-width: 1200px }
</css>
<js lib="jquery datatables responsive">
<![CDATA[

$(document).ready(function() {
	var table = $('#example').DataTable( {
		scrollY: 300,
		paging: false
	} );

	new $.fn.dataTable.Responsive( table );
} );

]]>
</js>

<title lib="Responsive">Vertical scrolling</title>

<info><![CDATA[

This example shows Responsive in use with the `dt-init scrollY` option to present a scrolling table (instead of using paging as the other Responsive examples do). Responsive will automatically work with the table in such a configuration.

Responsive can be used with `dt-init scrollX`, however it is relatively pointless as Responsive will remove columns to ensure that there is no horizontal scrolling!

]]></info>

</dt-example>

