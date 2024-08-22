/*
Template Name: brainchild soft - Admin & Dashboard Template
Author: Brainchild soft
Version: 1.1.0
Website: https://brainchildsoft.com/
Contact: brainchildsoft@gmail.com
File: datatable Js File
*/

new DataTable('#BCSDatatable', {
    "responsive": true,
    "lengthChange": true,
    dom:"<'grid grid-cols-12 lg:grid-cols-12 gap-3'" +
        // "<'self-center col-span-12'B>" +  // Buttons and Filtering input control on the right
        "<'self-center col-span-12 md:col-span-6 lg:col-span-6'l>" +  // Length changing input control on the left
        "<'self-center col-span-12 md:col-span-6 lg:col-span-6 lg:place-self-end'f>" +  // Buttons and Filtering input control on the right
        "<'my-2 col-span-12 lg:col-span-12'tr>" +  // The table itself, spanning full width
        "<'self-center col-span-12 lg:col-span-6'i>" +  // Table information summary on the left
        "<'self-center col-span-12 lg:place-self-end lg:col-span-6'p>" +  // Pagination control on the right
        ">",
    renderer: 'tailwindcss',
    processing: true,
    language: {
        processing: '<div class="dataTables_processing"><i class="fas fa-spinner fa-spin"></i> Loading...</div>'
    },
    drawCallback: function(settings) {
        window.setupActionMenu();
    }
});

//basic example
new DataTable('#basic_tables', {
    drawCallback: function(settings) {
        window.setupActionMenu();
    }
});

//Hoverable example
new DataTable('#borderedTable');

//Hidden columns
new DataTable('#hiddenColumns', {
    columnDefs: [
        {
            target: 2,
            visible: false,
            searchable: false
        },
        {
            target: 3,
            visible: false
        }
    ]
});

$('#withExportBtnDatatable').DataTable({
    dom:"<'grid grid-cols-12 lg:grid-cols-12 gap-3'" +
        "<'self-center col-span-12'B>" +  // Buttons and Filtering input control on the right
        "<'self-center col-span-12 lg:col-span-6'l>" +  // Length changing input control on the left
        "<'self-center col-span-12 lg:col-span-6 lg:place-self-end'f>" +  // Buttons and Filtering input control on the right
        "<'my-2 col-span-12 lg:col-span-12'tr>" +  // The table itself, spanning full width
        "<'self-center col-span-12 lg:col-span-6'i>" +  // Table information summary on the left
        "<'self-center col-span-12 lg:place-self-end lg:col-span-6'p>" +  // Pagination control on the right
        ">",
    buttons: [
        {
            extend: 'excelHtml5',
            className: 'bg-primary-500 text-white hover:bg-primary-600 border-primary-500',
            text: 'Excel'
        },
        {
            extend: 'pdfHtml5',
            className: 'bg-primary-500 text-white hover:bg-primary-600 border-primary-500',
            text: 'PDF'
        }
    ],
    drawCallback: function(settings) {
        window.setupActionMenu();
    }
});


$('#serverDatatable').DataTable({
    processing: true,
    serverSide: true,
    renderer: 'tailwindcss',
    ajax: {
        url: '../js/customer-list.json',
        type: 'GET',
        dataSrc: 'data'
    },
    dom:"<'grid grid-cols-12 lg:grid-cols-12 gap-3'" +
        "<'self-center col-span-12'B>" +  // Buttons and Filtering input control on the right
        "<'self-center col-span-12 lg:col-span-6'l>" +  // Length changing input control on the left
        "<'self-center col-span-12 lg:col-span-6 lg:place-self-end'f>" +  // Buttons and Filtering input control on the right
        "<'my-2 col-span-12 lg:col-span-12'tr>" +  // The table itself, spanning full width
        "<'self-center col-span-12 lg:col-span-6'i>" +  // Table information summary on the left
        "<'self-center col-span-12 lg:place-self-end lg:col-span-6'p>" +  // Pagination control on the right
        ">",
    buttons: [
        {
            extend: 'excelHtml5',
            className: 'bg-primary-500 text-white hover:bg-primary-600 border-primary-500',
            text: 'Excel'
        },
        {
            extend: 'pdfHtml5',
            className: 'bg-primary-500 text-white hover:bg-primary-600 border-primary-500',
            text: 'PDF'
        }
    ],
    columns: [
        { data: 'id', title: 'ID', searchable: false, orderable: false},
        { data: 'customer_name', title: 'Customer name', searchable: false, orderable: false},
        { data: 'email', title: 'Email', searchable: false, orderable: false},
        { data: 'date', title: 'Date', searchable: false, orderable: false},
        { data: 'phone', title: 'Phone', searchable: false, orderable: false},
        { data: 'status', title: 'Status', searchable: false, orderable: false,
            render: function(data, type, row) {
                if (data.toLowerCase() === 'active') {
                    return '<span class="bg-success-600 text-white px-3 py-1 rounded-md drop-shadow-md">Active</span>';
                } else if (data.toLowerCase() === 'block') {
                    return '<span class="bg-red-600 text-white px-3 py-1 rounded-md drop-shadow-md">Block</span>';
                } else {
                    return data;
                }
            }
        },
        { data: null, title: 'Actions', searchable: false, orderable: false,
            render: function(data, type, row) {
                return `<div class="relative inline-block text-left">
                            <button class="action-menu-btn inline-flex justify-center w-full rounded-md px-4 py-2  border border-slate-200 dark:border-slate-500/20
                                    bg-light dark:bg-darkHighlight text-sm font-medium text-gray-700 dark:text-dark hover:bg-gray-50
                                    shadow-sm drop-shadow-sm shadow-slate-50 dark:shadow-slate-700
                                    " id="menu-button" aria-expanded="true" aria-haspopup="true">
                                Actions
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M5.292 7.707a1 1 0 011.415 0L10 11.414l3.293-3.707a1 1 0 111.415 1.415l-4 4a1 1 0 01-1.415 0l-4-4a1 1 0 010-1.415z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <div class="action-menu hidden origin-top-right absolute right-0 mt-2 w-40 z-9999 rounded-md shadow-lg bg-light dark:bg-darkHighlight text-light dark:text-dark ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                                <div class="py-1" role="none">
                                    <a href="#!" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600" role="menuitem" tabindex="-1" id="menu-item-0" onclick="editRow(${row.id})">Edit</a>
                                    <a href="#!" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600" role="menuitem" tabindex="-1" id="menu-item-1" onclick="deleteRow(${row.id})">Delete</a>
                                </div>
                            </div>
                        </div>`;
            }
        }
    ],
    drawCallback: function(settings) {
        window.setupActionMenu();
    }
});

function editRow(id) {
    alert('Edit row with ID: ' + id);
}

function deleteRow(id) {
    alert('Delete row with ID: ' + id);
}
