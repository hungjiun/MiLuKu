'use strict'

import {ManagerTableConfig} from './managerTableConfig.js?v=1'

class ManagerTable {
    constructor (dom, ajaxUrl) {
        this.dom = dom;
        this.ajaxUrl = ajaxUrl;
        this.columns = ManagerTableConfig.columns;
        this.buttons = ManagerTableConfig.buttons;

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
        });
    }
}

export {ManagerTable}
