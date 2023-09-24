'use strict'

const columns =  [
    {title: 'ID', data: 'id', width: '50px', searchable: false, orderable: false },
    {title: 'Account', data: 'account', width: '100px', searchable: false, orderable: false },
    {title: 'Name', data: 'name', width: '100px', searchable: false, orderable: false },
    {title: 'Status Code', data: 'status', width: '100px', searchable: false, orderable: false, visible: false },
    {title: 'Status', data: 'status_text', width: '100px', searchable: false, orderable: false },
    {title: 'Created_At', data: 'created_at', width: '100px', searchable: false, orderable: false },
    {title: 'Updated_At', data: 'updated_at', width: '100px', searchable: false, orderable: false }
];

const buttons = [

];

class ManagerTableConfig {
    static get columns() {
        return columns;
    }

    static get buttons() {
        return buttons;
    }
}

export {ManagerTableConfig}
