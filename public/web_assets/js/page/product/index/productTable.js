'use strict'

import {ProductTableConfig} from './productTableConfig.js?v=1'

class ProductTable {
    constructor (dom, ajaxUrl) {
        this.dom = dom;
        this.ajaxUrl = ajaxUrl;
        this.columns = ProductTableConfig.columns;
        this.buttons = ProductTableConfig.buttons;

        this.initTable();
    }

    initTable()
    {
        $(this.dom).DataTable({
            'serverSide': true,
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "autoWidth": true,
            "scrollX": true,
            "processing": true,
            "ajax": {
                "url": this.ajaxUrl,
                "data": function (d) {

                },
            },
            "columns": this.columns,
            "buttons":  this.buttons,
            "dom": 'Bfrtip',
        });
    }
}

export {ProductTable}
