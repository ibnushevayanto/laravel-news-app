<textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" rows="3"
    placeholder="Tulis Komentar..."></textarea>
@if ($errors->has('content'))
<div class="invalid-feedback">{{ $errors->first('content') }}</div>
@endif
<div class="text-right">
    <button class="btn btn-danger mt-3" type="reset"><i class="fa fa-undo mr-1"></i>
        Reset</button>
    <button class="btn btn-primary mt-3" type="submit"><i class="fa fa-paper-plane mr-1"></i>
        Kirim</button>
</div>