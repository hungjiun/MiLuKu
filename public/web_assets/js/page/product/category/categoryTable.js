'use strict'

import {CategoryTableConfig} from './categoryTableConfig.js?v=2'

class CategoryTable {
    constructor (dom, ajaxUrl) {
        this.dom = dom;
        this.ajaxUrl = ajaxUrl;
        this.columns = CategoryTableConfig.columns;
        this.buttons = CategoryTableConfig.buttons;

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

export {CategoryTable}
