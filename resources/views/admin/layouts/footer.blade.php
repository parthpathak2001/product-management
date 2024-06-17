<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>document.write(new Date().getFullYear())</script> © {{ config('app.name') }}.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Develop by <a href="{{ env('DEVELOPER_INSTAGRAM') }}" target="_blank"> {{ env('DEVELOPER_NAME') }} </a>
                </div>
            </div>
        </div>
    </div>
</footer>
