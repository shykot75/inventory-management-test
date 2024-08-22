export default class GridJsBcs extends gridjs.Grid {
    constructor(options) {
        const defaultOptions = {
            pagination: {
                enabled: true,
                limit: 10
            },
            search: true,
            sort: true,
            className: {
                container: 'dataTables_wrapper dt-tailwindcss',
                table: 'dataTable w-full text-sm align-middle whitespace-nowrap',
                thead: 'table-head border-b border-slate-200 dark:border-zinc-500',
                tfoot: 'table-head border-b border-slate-200 dark:border-zinc-500',
                th: 'px-3 py-2 font-semibold table-th',
                td: 'p-3 border border-slate-200 dark:border-zinc-500',
                pagination: 'flex justify-between item-center my-4',
                paginationButton: 'relative text-light dark:text-dark inline-flex justify-center items-center space-x-2 border px-4 py-2 -mr-px leading-6 hover:z-10 focus:z-10 active:z-10 border-slate-200 active:border-slate-200 active:shadow-none dark:border-zinc-500 dark:active:border-zinc-400',
                paginationButtonCurrent: 'bg-primary-600 text-white border-primary-700',
                paginationButtonNext: 'rounded-r-lg',
                paginationButtonPrev: 'rounded-l-lg',
                paginationSummary: 'text-current',
                search: 'gridjs-search inline-block w-auto ml-2',
                sort: 'cursor-pointer text-primary-500'
            },
        };
        super(Object.assign({}, defaultOptions, options));
    }
}