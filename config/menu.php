<?php
return [
            [
                'name' => 'Home',
                'route' => 'admin.index',
                'icon' => ' fa-home',
            ],
            
            [
                'name' => 'Danh mục',
                'route' => 'danhmuc.index',
                'icon' => 'fa-certificate menu-icon',
                'items' => [
                    [
                        'name' => 'Chức vụ',
                        'route' => 'chucvu.index'
                    ],
                    [
                        'name' => 'Tình trạng',
                        'route' => 'tinhtrang.index'
                    ],
                    [
                        'name' => 'Xuất xứ',
                        'route' => 'xuatxu.index'
                    ],
                    [
                        'name' => 'Nhà cung cấp',
                        'route' => 'nhacungcap.index'
                    ],
                    [
                        'name' => 'Bảo hành',
                        'route' => 'baohanh.index'
                    ],
                ]
            ],
            [
                'name' => 'Nhân viên',
                'route' => 'nhanvien.index',
                'icon' => 'fa-user menu-icon',
            ],
            [
                'name' => 'Khách hàng',
                'route' => 'khachhang.index',
                'icon' => 'fa-users menu-icon',
            ],
            [
                'name' => 'Sản phẩm',
                'route' => 'sanpham.index',
                'icon' => 'fa-camera menu-icon',
            ],
            [
                'name' => 'File manager',
                'route' => 'admin.file',
                'icon' => 'fa-file menu-icon',
            ],
            [
                'name' => 'Phí vận chuyển',
                'route' => 'phivanchuyen.index',
                'icon' => 'fa-money menu-icon',
            ],
            [
                'name'=>'Đơn hàng',
                'route'=>'order.index', 
                'icon'=>' fa-shopping-cart menu-icon'
            ],
           
            
            
           
            
            

            
];


?>