const mix = require('laravel-mix');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
mix.webpackConfig({plugins: [new CleanWebpackPlugin()]})
    .setPublicPath('resource/build')
    .setResourceRoot('/assets/vendor/boilerplate');

// ============== AdminLTE & default ==============

mix.js('resource/assets/js/bootstrap.js', 'resource/build/bootstrap.min.js').version();
mix.js('resource/assets/js/admin-lte.js', 'resource/build/admin-lte.min.js').version();
mix.js('resource/assets/js/boilerplate.js', 'resource/build/boilerplate.min.js').version();

mix.sass('resource/assets/scss/adminlte.scss', 'resource/build/adminlte.min.css').version();

mix.copy('resource/assets/images/avatar.png', 'resource/build/images/avatar.png', false);

// ============== Moment ==============

mix.scripts([
    'node_modules/moment/min/moment-with-locales.min.js',
], 'resource/build/plugin/moment/moment-with-locales.min.js').version();

// ============== Datatables ==============

mix.scripts([
    'node_modules/datatables.net/js/jquery.dataTables.min.js',
    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
    'node_modules/drmonty-datatables-plugins/dataRender/datetime.js',
    'node_modules/drmonty-datatables-plugins/sorting/datetime-moment.js',
    'resource/assets/js/datatables.js',
], 'resource/build/plugin/datatables/datatables.min.js').version();

mix.copy('node_modules/drmonty-datatables-plugins/i18n', 'resource/build/plugin/datatables/i18n/', false);

mix.styles(
    'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
    'resource/build/plugin/datatables/datatables.min.css'
).version();

// ============== Select2 ==============

mix.scripts([
    'node_modules/select2/dist/js/select2.full.min.js'
], 'resource/build/plugin/select2/select2.full.min.js').version();

mix.copy('node_modules/select2/dist/js/i18n', 'resource/build/plugin/select2/i18n/', false);


// ============== DatePicker ==============

mix.sass('resource/assets/scss/daterangepicker.scss', 'resource/build/plugin/datepicker/datepicker.min.css').version();

mix.scripts([
    'node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js',
    'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
], 'resource/build/plugin/datepicker/datepicker.min.js').version();

// ============== FileInput ==============

mix.sass(
    'node_modules/bootstrap-fileinput/scss/fileinput.scss',
    'resource/build/plugin/fileinput/bootstrap-fileinput.min.css'
).version();

mix.scripts([
    'node_modules/bootstrap-fileinput/js/fileinput.min.js',
], 'resource/build/plugin/fileinput/bootstrap-fileinput.min.js').version();

mix.copy('node_modules/bootstrap-fileinput/js/locales', 'resource/build/plugin/fileinput/locales', false);

// ============== Nestable ==============

mix.styles(
    'node_modules/nestable2/jquery.nestable.css',
    'resource/build/plugin/nestable2/jquery.nestable.min.css'
).version();

mix.scripts([
    'node_modules/nestable2/jquery.nestable.js',
], 'resource/build/plugin/nestable2/jquery.nestable.min.css').version();

// ============== Fontawesome iconpicker ==============

mix.less(
    'node_modules/fontawesome-iconpicker/src/less/iconpicker.less',
    'resource/build/plugin/fontawesome-iconpicker/fontawesome-iconpicker.min.css'
).version();

mix.scripts([
    'node_modules/fontawesome-iconpicker/src/js/iconpicker.js',
], 'resource/build/plugin/fontawesome-iconpicker/fontawesome-iconpicker.min.js').version();

// ============== Duallistbox ==============

mix.styles(
    'node_modules/bootstrap4-duallistbox/src/bootstrap-duallistbox.css',
    'resource/build/plugin/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'
).version();

mix.scripts([
    'node_modules/bootstrap4-duallistbox/src/jquery.bootstrap-duallistbox.js',
], 'resource/build/plugin/bootstrap4-duallistbox/bootstrap-duallistbox.min.js').version();