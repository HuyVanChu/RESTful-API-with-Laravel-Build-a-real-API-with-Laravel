<?php

namespace App\Http\Controllers\Category;


use App\Http\Controllers\ApiController;
use App\Model\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index()
    {
        $category=Category::all();
        return $this->showAll($category);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'description' => 'required',
        ]);
        $category=new Category($request->all());
        return $this->showOne($category, 201);
    }

    public function show(category $category)
    {
        return $this->showOne($category);
    }

    public function update(Request $request, category $category)
    {
        /**
         * 1.fill: truong hop da co model va muon dien du lieu vao 1 array
         * 2.Các intersect: khi nhan request -> loc du lieu co trong fill
         *  phương pháp loại bỏ bất kỳ giá trị từ bộ sưu tập ban đầu mà không có mặt trong cho arrayhay bộ sưu tập.
         *  Bộ sưu tập kết quả sẽ lưu giữ các khóa của bộ sưu tập ban đầu
         * 3. trong form neu thieu cac truong trong fill -> khong the update 
         */
        $category->fill($request->intersect(
            [
                'name',
                'description'
            ]
        ));
        if ($category->isClean()) {
            return $this->errorResponser('Yc khong the thuc hien', 422);
        }
        $category->save();
        return $this->showOne($category);
    }

    public function destroy(category $category)
    {
        $category->delete();
        return $this->showOne($category);
    }
}
