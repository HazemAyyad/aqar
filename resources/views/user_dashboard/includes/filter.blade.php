<form action="{{ route('user.dashboard') }}" method="GET">
    <div class="wd-filter">
        <div class="ip-group">
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}">
        </div>
        <div class="ip-group icon">
            <input type="text" name="from_date" id="datepicker1" class="ip-datepicker icon" placeholder="From Date" value="{{ request('from_date') }}">
        </div>
        <div class="ip-group icon">
            <input type="text" name="to_date" id="datepicker2" class="ip-datepicker icon" placeholder="To Date" value="{{ request('to_date') }}">
        </div>
        <div class="ip-group">
            <select name="date_filter" id="date_filter" class="form-select">
                <option value="" {{ request('date_filter') == '1' ? 'selected' : '' }}>Select</option>
                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Today</option>
                <option value="yesterday" {{ request('date_filter') == 'yesterday' ? 'selected' : '' }}>Yesterday</option>
            </select>

         </div>
        <div class="ip-group">
            <button class="tf-btn primary" type="submit">Filter</button>
        </div>
    </div>

</form>
