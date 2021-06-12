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
        color: #27a9e3;
    }

    .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        cursor: auto;
        background-color: #fff;
        border-color: #dee2e6;
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
        color: #7460ee;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .page-link:hover {
        z-index: 2;
        color: #381be7;
        text-decoration: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    .page-link:focus {
        z-index: 2;
        outline: 0;
        -webkit-box-shadow: transparent;
        box-shadow: transparent;
    }

    #pagination .page-item.active .page-link {
        background-color: #27a9e3;
        border-color: #27a9e3;
    }

    .page-item.active .page-link {
        z-index: 1;
        color: #fff;
        background-color: #2962FF;
        border-color: #2962FF;
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