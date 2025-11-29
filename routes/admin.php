<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    // '/'         => (new HomeController)->index(),
    '/'             => (new ProductController)->dashboad(),

    // CRUD PRODUCT
    'list-product'  => (new ProductController)->index(),
    'delete-product' => (new ProductController)->delete(),
    'show-product'  => '', // Hiển thị thông tin chi tiết
    'create-product' => (new ProductController)->create(), // Hiển thị form tạo mới
    'store-product' => (new ProductController)->store(), // Lưu thông tin tạo mới vào CSDL
    'edit-product' => '', // Hiển thị form cập nhật
    'update-product' => '' // Lưu thông tin cập nhật vào CSDL
};
