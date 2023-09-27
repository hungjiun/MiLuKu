'use strict'

import {CategoryTable} from './categoryTable.js?v=2'

class Category {
    constructor (url) {
        this.url = url;
        this.table;
    }

    creteTable(dom)
    {
        this.table = new CategoryTable(dom, this.url);
    }
}

export {Category}
