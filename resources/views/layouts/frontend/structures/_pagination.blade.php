<style>
    #pagination {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 15px;
    }

    #pagination ul.pagination {
        margin-bottom: 0;
    }

    .pagination {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 2px;
    }

    #pagination .page-item:not(.active) .page-link {
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
    }

    .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: 2px;
        border-bottom-left-radius: 2px;
    }

    .page-link:not(:disabled):not(.disabled) {
        cursor: pointer;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
    }

    .page-link:hover {
        z-index: 2;
        text-decoration: none;
    }

    .page-link:focus {
        z-index: 2;
        outline: 0;
        -webkit-box-shadow: transparent;
        box-shadow: transparent;
    }

    #pagination .page-item.active .page-link {
        background-color: #00acc1;
        border-color: #00acc1;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #00acc1;
        border-color: #00acc1;
    }

</style>

<div id="pagination">
    <div class="pagination_info">
        <div class="dataTables_info" id="zero_config_info" role="status">
            {{ transF('common.pagination.show') }} {{ $paginator->firstItem() }}  {{ transF('common.pagination.to') }}
            {{ $paginator->lastItem() }} {{ transF('common.pagination.of') }}
            {{ $paginator->total() }} {{ transF('common.pagination.records') }}
        </div>
    </div>
    <div class="pagination_page">
        <div class="dataTables_paginate paging_simple_numbers float-right"
             id="zero_config_paginate">
            {{ $paginator->appends($_GET)->links() }}
        </div>
    </div>
</div>