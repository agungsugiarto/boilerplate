<!-- Push section css -->
<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<?= $this->endSection() ?>

<!-- Push section js -->
<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/moment@2.24.0/min/moment-with-locales.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    moment.locale('<?= config('App')->defaultLocale ?>');
</script>
<script>
    $.extend( true, $.fn.dataTable.defaults, {
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/<?= config('Boilerplate')->i18n ?>.json"
        }
    });
</script>
<?= $this->endSection() ?>