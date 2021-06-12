<fieldset>
    <style>
        label[for="gender-boy"], label[for="gender-girl"] {
            cursor: pointer;
        }
    </style>
    <label>Gender</label>
    <div style="padding-left: 30px">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="{{ genderGirl() }}" id="gender-girl"
                    {{ $entity->gender == genderGirl() ? "checked" : '' }}>
            <label class="form-check-label" for="gender-girl">{{ transF('form.girl') }}</label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="gender" value="{{ genderBoy() }}" id="gender-boy"
                    {{ $entity->gender == genderBoy() ? "checked" : '' }}>
            <label class="form-check-label" for="gender-boy">{{ transF('form.boy') }}</label>
        </div>
    </div>
</fieldset>