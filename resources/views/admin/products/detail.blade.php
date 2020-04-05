{{-- Modal show chi tiết todo --}}
<div class="modal fade bd-example-modal-xl" id="show">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="col-12 modal-title text-center" id="name" style="color:blue; font-weight: bold;"></h4>
                <h4 class="col-12 modal-title text-center" id="title" style="color:blue; font-weight: bold;"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <h1 id="descriptor"></h1>
                <i style="float:right">
                    <span id="last_updated">Last updated:</span><br>
                    <span id="user_created">User created:</span><br>
                    <span id="user_updated">User updated:</span>
                </i>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>