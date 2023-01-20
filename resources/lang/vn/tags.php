<?php
/*
language : Vietnamse
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
            'title' => 'Thêm thẻ',
            'message' => [
                'success' => "Đã lưu thẻ thành công.",
                'error' => "Đã xảy ra lỗi khi lưu thẻ. :error"
            ]
        ],
        'update' => [
            'title' => 'Edit tag',
            'message' => [
                'success' => "Đã cập nhật thẻ thành công.",
                'error' => "Đã xảy ra lỗi khi cập nhật thẻ. :error"
            ]
        ],
        'delete' => [
            'title' => 'Delete tag',
            'message' => [
                'confirm' => "Are you sure you want to delete the :title tag?",
                'success' => "Tag deleted successfully.",
                'error' => "An error occurred while deleting the tag. :error"
            ]
        ],
    ]
];

