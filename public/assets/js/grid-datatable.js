// Initialize the custom grid
import GridJsBcs from "../libs/gridjs/gridjs.bcs";

const basicGridTable = new GridJsBcs({
    columns: [
        'ID', 'Customer Name', 'Email', 'Date', 'Phone',
        { name: 'Status', formatter: (cell) => gridjs.html(`<span class="badge ${cell === 'Active' ? 'bg-success' : 'bg-danger'}">${cell}</span>`) },
        { name: 'Actions', sort: false, formatter: (_, row) => gridjs.html(
                `<div class="relative inline-block text-left">
                    <button type="button" class="action-menu-btn inline-flex justify-center w-full rounded-md px-4 py-2  border border-slate-200 dark:border-slate-500/20
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
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600">Edit</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600" >Delete</a>
                        </div>
                    </div>
                </div>`
            )
        },
        { name: 'Actions', sort: false, formatter: (_, row) => gridjs.html(
                `<div class="relative inline-block text-left">
                    <button type="button" class="action-menu-btn inline-flex justify-center w-full rounded-md px-4 py-2  border border-slate-200 dark:border-slate-500/20
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
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600">Edit</a>
                            <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-slate-600" >Delete</a>
                        </div>
                    </div>
                </div>`
            )
        }
    ],
    server: {
        url: '../js/customer-list.json',
        then: function (res) {
            return res.data.map(item => [
                item.id,
                item.customer_name,
                item.email,
                item.date,
                item.phone,
                item.status,
                null
            ])
        },
    },
}).render(document.getElementById('basic-grid-datatable'));


// Ensure action menu setup is called after rendering Grid.js
basicGridTable.on('ready', window.setupActionMenu());
function editRow(id) {
    alert('Edit row with ID: ' + id);
}

function deleteRow(id) {
    alert('Delete row with ID: ' + id);
}