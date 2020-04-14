const mix = require('laravel-mix');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');
mix.webpackConfig({plugins: [new CleanWebpackPlugin()]})
    .setPublicPath("public")
    .setResourceRoot('/assets/vendor/boilerplate');

// ============== AdminLTE & default ==============

mix.js('resource/assets/js/bootstrap.js', 'public/bootstrap.min.js').version();
mix.js('resource/assets/js/admin-lte.js', 'public/admin-lte.min.js').version();
mix.js('resource/assets/js/boilerplate.js', 'public/boilerplate.min.js').version();

mix.sass('resource/assets/scss/adminlte.scss', 'public/adminlte.min.css').version();

mix.copy('resource/images/avatar.png', 'public/images/avatar.png', false);

// ============== Moment ==============

mix.scripts([
    'node_modules/moment/min/moment-with-locales.min.js',
], 'public/plugin/moment/moment-with-locales.min.js').version();

// ============== Datatables ==============

mix.scripts([
    'node_modules/datatables.net/js/jquery.dataTables.min.js',
    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
    'node_modules/drmonty-datatables-plugins/dataRender/datetime.js',
    'node_modules/drmonty-datatables-plugins/sorting/datetime-moment.js',
    'resource/assets/js/datatables.js',
], 'public/plugin/datatables/datatables.min.js').version();

mix.copy('node_modules/drmonty-datatables-plugins/i18n', 'public/plugin/datatables/i18n/', false);

mix.styles(
    'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
    'public/plugin/datatables/datatables.min.css'
).version();

// ============== Select2 ==============

mix.scripts([
    'node_modules/select2/dist/js/select2.full.min.js'
], 'public/plugin/select2/select2.full.min.js').version();

mix.copy('node_modules/select2/dist/js/i18n', 'public/plugin/select2/i18n/', false);


// ============== DatePicker ==============

mix.sass('resource/assets/scss/daterangepicker.scss', 'public/plugin/datepicker/datepicker.min.css').version();

mix.scripts([
    'node_modules/admin-lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js',
    'node_modules/admin-lte/plugins/daterangepicker/daterangepicker.js',
], 'public/plugin/datepicker/datepicker.min.js').version();

// ============== FileInput ==============

mix.sass(
    'node_modules/bootstrap-fileinput/scss/fileinput.scss',
    'public/plugin/fileinput/bootstrap-fileinput.min.css'
).version();

mix.scripts([
    'node_modules/bootstrap-fileinput/js/fileinput.min.js',
], 'public/plugin/fileinput/bootstrap-fileinput.min.js').version();

mix.copy('node_modules/bootstrap-fileinput/js/locales', 'public/plugin/fileinput/locales', false);

// ======= Code Mirror
mix.scripts(['node_modules/codemirror/lib/codemirror.js'], 'public/plugin/codemirror/codemirror.min.js').version();
mix.scripts(['resource/assets/js/vendor/codemirror/jquery.codemirror.js'], 'public/plugin/codemirror/jquery.codemirror.min.js').version();

mix.copy('node_modules/codemirror/addon', 'public/plugin/codemirror/addon');
mix.copy('node_modules/codemirror/mode', 'public/plugin/codemirror/mode');
mix.copy('node_modules/codemirror/theme', 'public/plugin/codemirror/theme');

mix.sass('resource/assets/js/vendor/codemirror/theme/storm.scss', 'public/plugin/codemirror/theme/storm.css');

mix.styles('node_modules/codemirror/lib/codemirror.css', 'public/plugin/codemirror/codemirror.min.css').version();

// ============== TinyMCE ==============

mix.copy('node_modules/tinymce/plugins', 'public/plugin/tinymce/plugins');
mix.scripts('resource/assets/js/vendor/tinymce/plugins/codemirror/plugin.js', 'public/plugin/tinymce/plugins/codemirror/plugin.min.js');
mix.scripts('resource/assets/js/vendor/tinymce/plugins/customalign/plugin.js', 'public/plugin/tinymce/plugins/customalign/plugin.min.js');
mix.copy('resource/assets/js/vendor/tinymce/plugins', 'public/plugin/tinymce/plugins');
mix.copy('node_modules/tinymce/skins', 'public/plugin/tinymce/skins');
mix.copy('node_modules/tinymce/themes', 'public/plugin/tinymce/themes');
mix.copy('node_modules/stickytoolbar/dist', 'public/plugin/tinymce/plugins');

// Boilerplate skin
mix.copy('resource/assets/js/vendor/tinymce/skins/boilerplate/fonts', 'public/plugin/tinymce/skins/ui/boilerplate/fonts');
mix.sass('resource/assets/js/vendor/tinymce/skins/boilerplate/content.inline.scss', 'public/plugin/tinymce/skins/ui/boilerplate/content.inline.min.css');
mix.sass('resource/assets/js/vendor/tinymce/skins/boilerplate/content.mobile.scss', 'public/plugin/tinymce/skins/ui/boilerplate/content.mobile.min.css');
mix.sass('resource/assets/js/vendor/tinymce/skins/boilerplate/content.scss', 'public/plugin/tinymce/skins/ui/boilerplate/content.min.css');
mix.sass('resource/assets/js/vendor/tinymce/skins/boilerplate/skin.scss', 'public/plugin/tinymce/skins/ui/boilerplate/skin.min.css');
mix.sass('resource/assets/js/vendor/tinymce/skins/boilerplate/skin.mobile.scss', 'public/plugin/tinymce/skins/ui/boilerplate/skin.mobile.min.css');

// https://www.tiny.cloud/get-tiny/language-packages/
mix.copy('resource/assets/js/vendor/tinymce/langs', 'public/plugin/tinymce/langs');

mix.scripts([
    'node_modules/tinymce/tinymce.min.js',
    'node_modules/tinymce/jquery.tinymce.min.js'
], 'public/plugin/tinymce/tinymce.min.js').version();

// ============== Nestable ==============

mix.styles(
    'node_modules/nestable2/jquery.nestable.css',
    'public/plugin/nestable2/jquery.nestable.min.css'
).version();

mix.scripts([
    'node_modules/nestable2/jquery.nestable.js',
], 'public/plugin/nestable2/jquery.nestable.min.css').version();

// ============== Fontawesome iconpicker ==============

mix.less(
    'node_modules/fontawesome-iconpicker/src/less/iconpicker.less',
    'public/plugin/fontawesome-iconpicker/fontawesome-iconpicker.min.css'
).version();

mix.scripts([
    'node_modules/fontawesome-iconpicker/src/js/iconpicker.js',
], 'public/plugin/fontawesome-iconpicker/fontawesome-iconpicker.min.js').version();

// ============== Duallistbox ==============

mix.styles(
    'node_modules/bootstrap4-duallistbox/src/bootstrap-duallistbox.css',
    'public/plugin/bootstrap4-duallistbox/bootstrap-duallistbox.min.css'
).version();

mix.scripts([
    'node_modules/bootstrap4-duallistbox/src/jquery.bootstrap-duallistbox.js',
], 'public/plugin/bootstrap4-duallistbox/bootstrap-duallistbox.min.js').version();