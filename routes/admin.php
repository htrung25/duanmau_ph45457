<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'             => (new ProductController)->dashboad(),

    // CRUD PRODUCT
    'list-product'  => (new ProductController)->index(),
    'delete-product' => (new ProductController)->delete(),
    'show-product'  => (new ProductController)->show(), // Hiển thị thông tin chi tiết
    'create-product' => (new ProductController)->create(), // Hiển thị form tạo mới
    'store-product' => (new ProductController)->store(), // Lưu thông tin tạo mới vào CSDL
    'edit-product' => (new ProductController)->edit(), // Hiển thị form cập nhật
    'update-product' => (new ProductController)->update(), // Lưu thông tin cập nhật vào CSDL

    //CRUD Category
    'list-category' => (new CategoryController)->index(),
    'create-category' => (new CategoryController)->create(),
    'store-category' => (new CategoryController)->store(),
    'edit-category' => (new CategoryController)->edit(),
    'update-category' => (new CategoryController)->update(),
    'delete-category' => (new CategoryController)->delete(),
    'list-comment' => (new CommentController)->index(),
    'delete-comment' => (new CommentController)->delete(),
    // CRUD User (admin)
    'list-user' => (new UserController)->index(),
    'create-user' => (new UserController)->create(),
    'store-user' => (new UserController)->store(),
    'edit-user' => (new UserController)->edit(),
    'update-user' => (new UserController)->update(),
    'delete-user' => (new UserController)->delete(),
};
