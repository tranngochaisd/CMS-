<?php
/*
language : Vietnamese
*/
return [
    'title' => [
        'index' => 'Thể Loại',
        'create' => 'Thêm Thể Loại',
        'edit' => 'Sửa Thê Loại',
        'detail' => 'Chi Tiết Thể Loại',
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Chưa có dữ liệu danh mục",
            'search' => ":keyword nó éo tồn tại",
        ]
    ]
    ,
    'form_control' => [
        'input' => [
            'title' => [
                'label' => 'Tiêu đề',
                'placeholder' => 'Nhập tiêu đề',
                'attribute' => 'thuộc tính'
            ],
            'slug' => [
                'label' => 'Slug',
                'placeholder' => 'Tự Động Tạo',
                'attribute' => 'slug'
            ],
            'thumbnail' => [
                'label' => 'Hình tiêu đề',
                'placeholder' => 'Trình duyệt tiêu đề',
                'attribute' => 'Hình tiêu đề'
            ],
            'search' => [
                'label' => 'Tìm Kiếm',
                'placeholder' => 'Tìm kiếm thể loại',
                'attribute' => 'Tìm Kiếm'
            ]
        ],
        'select' => [
            'parent_category' => [
                'label' => 'Gia phả hoặc chuỗi',
                'placeholder' => 'Chọn danh mục mẹ',
                'attribute' => 'gia phả hoặc chuỗi'
            ]
        ],
        'textarea' => [
            'description' => [
                'label' => 'Mô Tả',
                'placeholder' => 'Nhập mô tả',
                'attribute' => 'Mô Tả'
            ],
        ]
    ],
    'button' => [
        'create' => [
            'value' => 'Thêm'
        ],
        'save' => [
            'value' => 'Lưu'
        ],
        'edit' => [
            'value' => 'Sữa'
        ],
        'delete' => [
            'value' => 'Xóa'
        ],
        'cancel' => [
            'value' => 'Hủy'
        ],
        'browse' => [
            'value' => 'Trình Duyệt'
        ],
        'back' => [
            'value' => 'Thoát'
        ],
    ],
    'alert' => [
        'create' => [
            'title' => 'Thêm thể loại',
            'message' => [
                'success' => "Đã lưu danh mục thành công.",
                'error' => "Đã xảy ra lỗi khi lưu danh mục. :error"
            ]
        ],
        'update' => [
            'title' => 'Sủa thể loại',
            'message' => [
                'success' => "Cập nhật thể loại thành công.",
                'error' => "Đã xảy ra lỗi khi cập nhật danh mục. :error"
            ]
        ],
        'delete' => [
            'title' => 'Xóa Thể Loại',
            'message' => [
                'confirm' => "Bạn có chắc chắn muốn xóa thể loại :title ?",
                'success' => "Đã xóa danh mục thành công.",
                'error' => "Đã xảy ra lỗi khi xóa danh mục. :error"
            ]
        ],
    ]
];
