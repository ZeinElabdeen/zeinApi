<div class="kt-portlet__head-actions">
    <label for="image" class="btn">
                                        <span class="btn btn-brand btn-elevate btn-icon-sm">
                                            <i class="la la-plus"></i>
                                            اختر الصورة
                                        </span>
        <span id="imageName"></span>
    </label>
    <input id="image" type="file" class="form-control" name="image" style="display:none;" autocomplete="off">
    @if ($errors->has('image'))
        <span class="form-text text-muted">
                                        <strong class="text text-danger">الصورة مطلوبة ويجب ان تكون بصيغة jpg,jpeg,png </strong>
                                    </span>
    @endif

</div>
