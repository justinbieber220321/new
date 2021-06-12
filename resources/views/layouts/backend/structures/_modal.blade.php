<div class="modal fade modal_confirm" id="modal_confirm_delete" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" class="form_confirm_delete">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Delete it, are you sure?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-sm btn-danger">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal_confirm" id="modal_confirm_logout_all_devices" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" class="form_confirm_delete">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Đăng xuất khỏi tất cả thiết bị, kể cả thiết bị này, bạn có chắc không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-sm btn-danger">Đúng</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal_confirm" id="modal_confirm_logout_all_devices_ignore_myself" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="" method="POST" class="form_confirm_delete">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    Đăng xuất khỏi tất cả thiết bị, ngoại trừ thiết bị này, bạn có chắc không?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Thoát</button>
                    <button type="submit" class="btn btn-sm btn-danger">Đúng</button>
                </div>
            </form>
        </div>
    </div>
</div>