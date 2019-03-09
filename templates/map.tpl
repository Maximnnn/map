<div class="container">

    <h1 class="text-center">Map Tool</h1>

    <form class="form-inline pt-3" id="searchForm">

        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control datepicker" name="searchFrom" placeholder="from">
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <input type="text" class="form-control datepicker" name="searchTo" placeholder="to">
        </div>

        <button type="submit" class="btn btn-primary mb-2">Search</button>
    </form>

    <div class="row">
        <div class="col-12" style="height: 500px" id="map"></div>
    </div>
</div>