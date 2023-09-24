'use strict'

import {ManagerTable} from './managerTable.js?v=1'

class Manager {
    constructor (url) {
        this.url = url;
        this.table;
    }

    creteTable(dom)
    {
        this.table = new ManagerTable(dom, this.url);
    }
}

export {Manager}
