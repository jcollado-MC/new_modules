<?php





?>



<div id="my"></div>



<script src="../Jquery/jquery-3.4.1.min.js"></script>

<script>

    data = [
        ['Mazda', 2001, 2000, '2006-01-01'],
        ['Pegeout', 2010, 5000, '2005-01-01'],
        ['Honda Fit', 2009, 3000, '2004-01-01'],
        ['Honda CRV', 2010, 6000, '2003-01-01'],
    ];

    // Readonly first column
    $('#my').jexcel({
        data:data,
        colHeaders: ['Model', 'Date', 'Price', 'Date'],
        colWidths: [ 300, 80, 100, 100 ],
        columns: [
            { type: 'text', readOnly:true },
            { type: 'numeric' },
            { type: 'numeric' },
            { type: 'text' },
        ]
    });

    // Set readonly a specific column
    $('#my').jexcel('updateSettings', {
        cells: function (cell, col, row) {
            // If the column is number 4 or 5
            if (row == 2 && col == 2) {
                $(cell).addClass('readonly');
            }
        }
    });

</script>