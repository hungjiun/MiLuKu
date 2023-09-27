'use strict'

const columns =  [
    {title: 'ID', data: 'id', width: '50px', searchable: false, orderable: false },
    {title: 'Code', data: 'product_code', width: '100px', searchable: false, orderable: false },
    {title: 'Order', data: 'display_order', width: '100px', searchable: false, orderable: false },
    {title: 'Open Code', data: 'opeb', width: '100px', searchable: false, orderable: false, visible: false },
    {title: 'Open', data: 'open_text', width: '100px', searchable: false, orderable: false },
    {title: 'Status Code', data: 'status', width: '100px', searchable: false, orderable: false, visible: false },
    {title: 'Status', data: 'status_text', width: '100px', searchable: false, orderable: false },
    {title: 'Created_At', data: 'created_at', width: '100px', searchable: false, orderable: false },
    {title: 'Updated_At', data: 'updated_at', width: '100px', searchable: false, orderable: false }
];

const buttons = [
    {name: '新增', text: '新增商品', className: 'createProduct'}
];

class ProductTableConfig {
    static get columns() {
        return columns;
    }

    static get buttons() {
        return buttons;
    }
}

export {ProductTableConfig}
