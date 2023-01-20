<?php
/*
language : VietNames
*/
return [
    'title' => [
        'index' => 'Gửi bài',
        'create' => 'Viết bài',
        'edit' => 'Sửa Bài',
        'detail' => 'Xem chi tiết',
    ],
    'label' => [
        'no_data' => [
            'fetch' => "Chưa Nhập Dữ liệu",
            'search' => ":keyword éo tồn tại",
        ]
    ],
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
            ],
            'category' => [
                'label' => 'Thể Loại',
                'attribute' => 'Thể Loại'
            ],
            
        ],
        'select' => [
            'tag' => [
                'label' => 'Nhãn',
                'placeholder' => 'Nhập Nhãn',
                'attribute' => 'Nhãn',
                'option' => [
                    'publish' => 'Công Khai',
                    'draft' => 'Dự Thảo'
                ],
            ],
            'status' => [
                'label' => 'Trạng Thái',
                'placeholder' => 'Chọn trạng thái',
                'attribute' => 'Trạng Thái',
                'option' => [
                    'draft' => 'Bản thảo',
                    'publish' => 'Công bố',
                ]
            ],
        ],
        'textarea' => [
            'description' => [
                'label' => 'Miêu Tả',
                'placeholder' => 'Nhập Miêu Tả',
                'attribute' => 'Miêu Tả'
            ],
            'content' => [
                'label' => 'Nội Dung',
                'placeholder' => 'Nhập Nội Dung',
                'attribute' => 'Nội Dung'
            ],
        ]
    ],
    'button' => [
        'create' => [
            'value' => 'Tạo Bài'
        ],
        'save' => [
            'value' => 'Lưu'
        ],
        'edit' => [
            'value' => 'Sửa'
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
        'apply' => [
            'value' => 'Áp Dụng'
        ]
    ],
    'alert' => [
        'create' => [
            'title' => 'Tạo Bài',
            'message' => [
                'success' => "Đã lưu bài đăng thành công.",
                'error' => "Đã xảy ra lỗi khi lưu bài đăng. :error"
            ]
        ],
        'update' => [
            'title' => 'Sửa Bài',
            'message' => [
                'success' => "Đã cập nhật bài đăng thành công.",
                'error' => "Đã xảy ra lỗi khi cập nhật bài đăng. :error"
            ]
        ],
        'delete' => [
            'title' => 'Xóa Bài',
            'message' => [
                'confirm' => "Bạn có chắc chắn muốn xóa bài đăng :title ?",
                'success' => "Đã xóa bài viết thành công.",
                'error' => "Đã xảy ra lỗi khi xóa bài đăng. :error"
            ]
        ],
    ]
];