'use strict'

import {ProductTable} from './productTable.js?v=1'

class Product {
    constructor (url) {
        this.url = url;
        this.table;
    }

    creteTable(dom)
    {
        this.table = new ProductTable(dom, this.url);
    }
}

export {Product}
