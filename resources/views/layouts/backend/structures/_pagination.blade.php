<div class="row" id="pagination">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="zero_config_info" role="status">
            Show {{ $paginator->firstItem() }}  to {{ $paginator->lastItem() }} of {{ $paginator->total() }} record
        </div>
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers float-right"
             id="zero_config_paginate">
            {{ $paginator->appends($_GET)->links() }}
        </div>
    </div>
</div>