<?php

return [
    'global' => [
        'save'   => 'Simpan',
        'close'  => 'Tutup',
        'action' => 'Aksi',
        'logout' => 'Logout',
        'sweet'  => [
            'title'          => 'Apakah kamu yakin?',
            'text'           => 'Anda tidak akan dapat mengembalikan ini!',
            'confirm_delete' => 'Ya, hapus!',
        ],
    ],

    /**
     * Permission.
     */
    'permission' => [
        'add'      => 'Tambah izin',
        'edit'     => 'Ubah izin',
        'title'    => 'Pengelolan izin',
        'subtitle' => 'Daftar izin',
        'fields'   => [
            'name'            => 'Izin',
            'description'     => 'Deskripsi',
            'plc_name'        => 'Nama dari izin.',
            'plc_description' => 'Deskripsi untuk izin.',
        ],
        'msg' => [
            'msg_insert'   => 'Izin berhasil ditambahkan.',
            'msg_update'   => 'Izin id {0} berhasil dirubah.',
            'msg_delete'   => 'Izin id {0} berhasil dihapus.',
            'msg_get'      => 'Izin id {0} berhasil didapatkan.',
            'msg_get_fail' => 'Izin id {0} tidak ditemukan atau sudah dihapus.',
        ],
    ],

    /**
     * Role.
     */
    'role' => [
        'add'      => 'Tambah peran',
        'edit'     => 'Ubah peran',
        'title'    => 'Pengelolaan peran',
        'subtitle' => 'Daftar peran',
        'fields'   => [
            'name'            => 'Peran',
            'description'     => 'Deskripsi',
            'plc_name'        => 'Nama peran.',
            'plc_description' => 'Deskripsi untuk peran.',
        ],
        'msg' => [
            'msg_insert'   => 'Peran berhasil ditambahkan.',
            'msg_update'   => 'Peran id {0} berhasil dirubah.',
            'msg_delete'   => 'Peran id {0} berhasil dihapus.',
            'msg_get'      => 'Peran id {0} berhasil didapatkan.',
            'msg_get_fail' => 'Peran id {0} tidak ditemukan atau sudah dihapus.',
        ],
    ],

    /**
     * Menu.
     */
    'menu' => [
        'expand'   => 'Perlebar',
        'collapse' => 'Perkecil',
        'refresh'  => 'Perbaharui',
        'add'      => 'Tambah menu',
        'edit'     => 'Ubah menu',
        'title'    => 'Pengelolaan menu',
        'subtitle' => 'Daftar menu',
        'fields'   => [
            'parent'         => 'Induk',
            'warning_parent' => 'Tolong dicatat! menu hanya mendukung maksimal kedalaman 2.',
            'active'         => 'Aktif',
            'non_active'     => 'Tidak aktif',
            'icon'           => 'Ikon',
            'info_icon'      => 'Untuk ikon lainnya, silahkan lihat',
            'place_icon'     => 'Ikon dari fontawesome.',
            'name'           => 'Judul',
            'place_title'    => 'Nama untuk menu.',
            'route'          => 'Route',
            'place_route'    => 'Route untuk link menu.',
        ],
        'msg' => [
            'msg_insert'     => 'Menu berhasil ditambahkan.',
            'msg_update'     => 'Menu berhasil dirubah.',
            'msg_delete'     => 'Menu berhasil dihapus.',
            'msg_get'        => 'Menu berhasil didapatkan.',
            'msg_get_fail'   => 'Menu tidak ditemukan atau sudah dihapus.',
            'msg_fail_order' => 'Menu tidak berhasil di urutkan.',
        ],
    ],

    /**
     * user.
     */
    'user' => [
        'add'      => 'Tambah pengguna',
        'edit'     => 'Ubah pengguna',
        'title'    => 'Pengelolaan pengguna',
        'subtitle' => 'Daftar pengguna',
        'fields'   => [
            'active'          => 'Aktif',
            'profile'         => 'Profil',
            'join'            => 'Anggota sejak',
            'setting'         => 'Pengaturan',
            'non_active'      => 'Tidak aktif',
        ],
        'msg' => [
            'msg_insert'   => 'pengguna berhasil ditambahkan.',
            'msg_update'   => 'pengguna berhasil dirubah.',
            'msg_delete'   => 'pengguna berhasil dihapus.',
            'msg_get'      => 'pengguna berhasil didapatkan.',
            'msg_get_fail' => 'pengguna tidak ditemukan atau sudah dihapus.',
        ],
    ],
];
