<div class="pagination justify-content-md-center align-items-center m-auto">
    <select class="btn btn-primary paginating" name="sel_num_per_page" id="sel-num-per-page">
        @php
            $arrNumPerPage = [
                '10' => 10,
                '20' => 20,
                '50' => 50
            ];
            $urlParam = '&search=' . $search . '&num_per_page=' . $numPerPage;
        @endphp
        @foreach ($arrNumPerPage as $key => $value)
        @php
            $selected = '';
            if ($value == $numPerPage) {
                $selected = 'selected';
            }
        @endphp
        <option value="{{ $value }}" {{ $selected }}>{{ $key }}</option>
        @endforeach
    </select>
    <p class="text-uppercase text-secondary text-sm font-weight-bolder opacity-20 px-2">Page {{ $pageObject->currentPage() }} / {{ $pageObject->lastPage() }}</p>
    <button class="btn btn-primary" onclick="location.href='{{ $pageObject->previousPageUrl() . $urlParam}}'" {{ $pageObject->currentPage() == 1 ? 'disabled' : ''}}><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
    <button class="btn btn-primary" onclick="location.href='{{ $pageObject->nextPageUrl() . $urlParam}}'" {{ $pageObject->currentPage() == $pageObject->lastPage() ? 'disabled' : ''}}><i class="fa fa-chevron-right" aria-hidden="true"></i></button>
</div>