<?php
/**
 * Created by 信磊.
 * Date: 2019-01-14
 * Time: 22:23
 */

namespace App\Handlers;


class ImageUploadHandler
{
    // 设置允许上传图片的文件后缀
    protected $allowed_ext = ["png", "jpg", "jpeg", "gif"];

    /**
     * 图片保存
     *
     * @param $file
     * @param $folder
     * @param $file_prefix
     * @return array|bool
     */
    public function save ($file, $folder, $file_prefix)
    {
        // 构建储存文件夹规则，例如：uploads/images/avatars/201901/14/
        // 文件夹切割能更快定位文件位置
        $folder_name = "uploads/images/{$folder}/" . date("Ym/d", time());

        // 文件具体的储存物理路径，public_path() 获取的是 public 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/images/avatars/201709/21/
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名，因图片从剪切板黏贴时后缀名为空，所以确保此处后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: "png";

        // 拼接文件名，加前缀是为了增加文件辨别度，前缀可以是相关数据模型ID
        // 例如: 1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        // 如果上传的不是图片将中止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 将图片移动到目标储存路径中
        $file->move($upload_path, $filename);

        return [
            "path" => config("app.url") . "/{$folder_name}/{$filename}"
        ];
    }
}