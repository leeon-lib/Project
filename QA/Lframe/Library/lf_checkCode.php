<?php

/**
 *
 * 验证码类
 *
 * date : 		2015.05.17
 * author :		Liyn
 */
class lf_checkCode extends lf_controller {

    // 验证码文本域宽度
    public $width;
    // 验证码文本域高度
    public $height;
    // 文本域背景色
    public $bgcolor; //EDF7FF
    // 验证码个数
    public $codeLength = 4;
    // 验证码种子
    public $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    // 图像资源
    private $img;
    // 验证码
    private $code;

    /**
     * 调颜色
     *
     */
    public function __set($name, $value) {
        if ($name != 'color' || $value == '') {
            return false;
        }
        $this->color = $this->hex2rgb($value);
    }

    /**
     * 构造图形
     *
     */
    private function createImg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
    }

    /**
     * 颜色转换rgb
     *
     */
    private function hex2rgb($color) {
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }
        if (strlen($color) == 6) {
            list($r, $g, $b) = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            list($r, $g, $b) = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        }
        $r = hexdec($r);
        $g = hexdec($g);
        $b = hexdec($b);
        return array('red' => $r, 'green' => $g, 'blue' => $b);
    }

    /**
     * 生成随机验证码字符
     *
     */
    private function createCode() {
        $code = '';
        $len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codeLength; $i++) {
            $code .= $this->charset[mt_rand(0, $len)];
        }
        $this->code = $code;
    }

    /**
     * 写入内容
     *
     */
    private function writeCode() {
        // 循环已经生成的字符串，计算位置并随机字体颜色后写入画布
        for ($i = 0; $i < strlen($this->code); $i++) {
            // 计算每个字符在画布中的位置
            $x = ($this->width / $this->codeLength) * $i + $this->width / 20;
            $y = ($this->height + 20) / 2;
            // 颜色随机
            // $fontColor = imagecolorallocate($this->img, 255, mt_rand(0,255), mt_rand(0,255));
            // 白色字体
            // ****************此处字体颜色应该以系统配置参数设置，待修改
            $fontColor = imagecolorallocate($this->img, 0, 0, 0);
            // 写入画布
            imagettftext($this->img, 20, 0, $x, $y, $fontColor, LF_RESOURCES_PATH . 'font.ttf', $this->code[$i]);
        }
    }

    /**
     * 验证码主方法
     *
     */
    public function mkCheckCode($width = 130, $height = 30, $bgcolor = '#FFFFFF') {
        $this->width = $width;
        $this->height = $height;
        $this->bgcolor = $bgcolor;
        // 创建画布
        $this->createImg();
        // 颜色转换
        $cArr = $this->hex2rgb($this->bgcolor);
        // 调色
        $bgc = imagecolorallocate($this->img, $cArr['red'], $cArr['green'], $cArr['blue']);
        // 填充背景
        imagefill($this->img, 0, 0, $bgc);
        // 生成随机字符
        $this->createCode();
        // 写字符
        $this->writeCode();
        // 输出
        $this->outPut();
    }

    /**
     * 输出图像
     *
     */
    public function getCode() {
        return $this->code;
    }

    /**
     * 输出图像
     *
     */
    private function outPut() {
        header('Content-type:image/png');
        // 输出图像
        imagepng($this->img);
        // 释放资源
        imagedestroy($this->img);
    }

}
