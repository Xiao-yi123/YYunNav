<?php
namespace app\admin\service\define;

class Base64Service
{
    /**
     * 判断Base64数据是否是图片
     * @param $base64 base64元数据
     * @return false|int
     */
    public function isBase64Image($base64){
        $data = base64_decode($base64);
        $image = preg_match('%^data:image/[^;]+;base64,[0-9A-Za-z+/=]+$%', $base64);
        return $image;
    }

    /**
     * 把Base64数据保存在图片
     * @param $base64_data string base64数据
     * @param $path  string 保存路径
     * @param $name string   文件名
     * @return string
     */
    public function Base64ToImage($base64_data, $path, $name){
        //要将 base64 编码的数据流转换为文件，可以使用 PHP 内置的 base64_decode 函数将其解码，并将解码后的数据写入到文件中。
        //在上面的示例中，首先去除 base64 数据流的前缀，在解码之前需要将其移除。然后，使用 base64_decode 函数对数据进行解码，并将解码后的数据写入到文件中。最后，使用 fopen 和 fwrite 函数打开文件并写入数据，然后使用 fclose 函数关闭文件。
        // 去除 base64 数据流的前缀
        $base64_data = preg_replace('/^data:image\/\w+;base64,/', '', $base64_data);

        // 解码 base64 数据
        $decoded_data = base64_decode($base64_data);

        $ImageS = new ImageService();

        return $ImageS->DownloadImage($name,"",$path,$decoded_data);

    }

    public function ImageToBase64Data($image_file){
        // getimagesize获取图片的属性值返回一个数组，索引0对应图片宽度，索引1对应图片高度
        /*
         * getimagesize获取图片的属性值返回一个数组，这里 $image_info['mime'] 对应的值就是字符串 "image/jpeg"
         * 索引 0 给出的是图像宽度的像素值
         * 索引 1 给出的是图像高度的像素值
         * 索引 2 给出的是图像的类型，返回的是数字，其中1 = GIF，2 = JPG，3 = PNG，4 = SWF，5 = PSD，6 = BMP，7 = TIFF(intel byte order)，8 = TIFF(motorola byte order)，9 = JPC，10 = JP2，11 = JPX，12 = JB2，13 = SWC，14 = IFF，15 = WBMP，16 = XBM
         * 索引 3 给出的是一个宽度和高度的字符串，可以直接用于 HTML 的 <image> 标签
         * 索引 bits 给出的是图像的每种颜色的位数，二进制格式
         * 索引 channels 给出的是图像的通道值，RGB 图像默认是 3
         * 索引 mime 给出的是图像的 MIME 信息，此信息可以用来在 HTTP Content-type 头信息中发送正确的信息，如：
         * header("Content-type: image/jpeg");
         */
        $image_info = getimagesize ( $image_file );
        // 组合成base64编码
        // chunk_split 将 base64_encode() 的输出转换成符合 RFC 2045 语义的字符串。它会在每 chunklen（默认为 76）个字符后边插入 end（默认为空格 " "）
        // 此处不用chunk_split函数处理也行，对于<img>标签显示图像没影响
        // 字符串双引号中数组用{}扩起来，即可在字符串中正常显示其中内容
        $base64_image = "data:{$image_info['mime']};base64," . chunk_split ( base64_encode ( file_get_contents ( $image_file ) ) );
        return $base64_image;
    }

    /**
     * 反编译data/base64数据流并创建图片文件
     *
     * @param string $base64_image  base64数据流
     * @param string $put_url       存放图片文件目录，路径后不用加斜杠/
     * @param string $fileName      图片文件名称(不含文件后缀)
     * @return mixed                返回可在浏览器访问的图片地址或布尔类型
     */
    public function Base64DecImg($base64_image, $put_url, $fileName) {
//        data:image/*;base64 就是 Data URI scheme。
//Data URI scheme是在RFC2397中定义的，目的是将一些小的数据，直接嵌入到网页中，从而不用再从外部文件载入
//例如：
//data:image/jpeg;base64,/9j/4AAQSkZJRgABAgEBLAEsAAD/4RVFRXhpZgAATU0AKgAAAAgACgEPAA......
//base64码中，data表示取得数据的协定名称，image/jpeg 是数据类型名称，base64 是数据的编码方法，逗号后面就是这个文件base64编码后的数据
//
//目前，Data URI scheme支持的类型有：
//data:,文本数据
//data:text/plain,文本数据
//data:text/html,HTML代码
//data:text/html;base64,base64编码的HTML代码
//data:text/css,CSS代码
//data:text/css;base64,base64编码的CSS代码
//data:text/javascript,Javascript代码
//data:text/javascript;base64,base64编码的Javascript代码
//data:image/gif;base64,base64编码的gif图片数据
//data:image/png;base64,base64编码的png图片数据
//data:image/jpeg;base64,base64编码的jpeg图片数据
//data:image/x-icon;base64,base64编码的icon图片数据
//base64简单地说，它把一些 8-bit 数据翻译成标准 ASCII 字符，网上有很多免费的base64 编码和解码的工具
        // 浏览器访问当前路径URL
        $__URL__ = 'localhost/test/';
        try {
            // 分割base64码，获取头部编码部分
            $headData = explode ( ';', $base64_image );
            // 再获取编码前原文件的后缀信息
            $postfix = explode ( '/', $headData [0] );
            // 判断源文件是否是图片
            if (strstr ( $postfix [0], 'image' )) {
                // 判断是否是jpeg图片，并赋正确后缀名
                $postfix = $postfix [1] == 'jpeg' ? 'jpg' : $postfix [1];
                // 拼接要合成图片的完整路径及扩展名
                // DIRECTORY_SEPARATOR目录分隔符，由于win与linux目录分隔符不同，PHP根据当前系统返回正确目录分隔符。windows返回\ 或 /，linux返回/
                $file_url = $put_url . DIRECTORY_SEPARATOR . $fileName . '.' . $postfix;
                // 去掉$base64_image码中头部内容，获取文件编码部分内容
                $base64Arr = explode(",",$base64_image);
                // 经base64_decode解码
                $image_decode = base64_decode ($base64Arr[1] );
                try {
                    // 合成文件
                    file_put_contents ( $file_url, $image_decode );
                    // 返回可在浏览器访问的图片地址
                    return $__URL__ . $file_url;
                } catch ( \Exception  $e ) {
                    return false;
                }
            }
        } catch ( \Exception $e ) {
            return false;
        }
        return false;
    }
}
