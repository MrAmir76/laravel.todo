<div>
    <nav class="bg-info" style="padding: 10px">
        <button class="btn btn-danger close_" onclick="closeSearch()">بستن</button>
        <span class="advanceSearchTitle">جستوجوی وظایف</span>
    </nav>
    <form class=" col-10 mt-30" wire:submit.prevent="searchValidate">
        <div class="row relative">
            @error('inputSearch')
            <div class="col-10 m-auto">
                <x-error-form :message="$message"/>
            </div>
            @enderror
            <input class="form-control col-sm-9 inputSearch" type="search" placeholder="متنی وارد کنید" required
                   minlength="2" wire:model="inputSearch">
            <input type="submit" class="btn btn-success mt-2 h40" value="جستوجو">
        </div>
        <div class="row p-2">
            @error('scopeSearch')
            <div class="col-10 m-auto">
                <x-error-form :message="$message"/>
            </div>
            @enderror
            <h5>جستوجوی براساس</h5>
            <div class="mr-3">
                <div class="form-check mr-3">
                    <input class="form-check-input mt-2" type="radio" value="1"
                           wire:model="scopeSearch" id="t1" checked>
                    <label class="form-check-label mr-3" for="t1">عنوان و شرح وظیفه</label>
                </div>
                <div class="form-check mr-3 ">
                    <input class="form-check-input mt-2" type="radio" value="2"
                           wire:model="scopeSearch" id="t2">
                    <label class="form-check-label mr-3" for="t2"> نام انجام دهنده</label>
                </div>
                <div class="form-check mr-3">
                    <input class="form-check-input mt-2" type="radio" value="3"
                           wire:model="scopeSearch" id="t3">
                    <label class="form-check-label mr-3" for="t3">نتایج وظیفه</label>
                </div>
            </div>
        </div>
    </form>
    @include('include.script.closeSearchScript')
</div>
