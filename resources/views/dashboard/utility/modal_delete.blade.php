<div class="modal modal-blur fade" id="delete_modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="modal-title">@lang('site.are_you_sure')</div>
        <div>@lang('site.if_you_do_delete')</div>
        <input type="hidden" name="delete_val" value="0" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link link-secondary mr-auto" data-dismiss="modal">@lang('site.cancel')</button>
        <button type="button" class="btn btn-danger delete_it_sure" data-dismiss="modal">@lang('site.delete_it')</button>
      </div>
    </div>
  </div>
</div>
